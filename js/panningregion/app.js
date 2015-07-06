// Define the app and a region to show content
// -------------------------------------------

var App = new Backbone.Marionette.Application();

App.addRegions({
  "mainRegion": "#stackView" 
});

// Create a module to contain some functionality
// ---------------------------------------------

App.module("SampleModule", function(Mod, App, Backbone, Marionette, $, _){
  
  console.log(Mod, App, Backbone, Marionette, $, _);
  
  // The Stack Manager View
  // ----------------------
  
  var StackView = Marionette.View.extend({
    
    hasRootView: false,
    
    // Define options for transitioning views in and out
    defaults: {
      inTransitionClass: 'slideInFromRight',
      outTransitionClass: 'slideOutToRight',
      animationClass: 'animated',
      transitionDelay: 1000,
      'class': 'stacks',
      itemClass: 'stack-item'
    },
    
    initialize: function(options) {
      this.views = [];
      options = options || {};
      this.options = _.defaults({}, this.defaults, options);
    },
    
    setRootView: function(view) {
      this.hasRootView = true;
      this.views.push(view);
      view.render();
      view.$el.addClass(this.options.itemClass);
      this.$el.append(view.$el);
    },
    
    render: function() {
      this.$el.addClass(this.options['class']);
      return this;
    },
    
    // Pop the top-most view off of the stack.
    pop: function() {
      var self = this;
      if(this.views.length > (this.hasRootView ? 1 : 0)) {
        var view = this.views.pop();
        this.transitionViewOut(view);
      }
    },
    
    // Push a new view onto the stack.
    // The itemClass will be auto-added to the parent element.
    push: function(view) {
      this.views.push(view);
      view.render();
      view.$el.addClass(this.options.itemClass);
      this.transitionViewIn(view);
      //console.log(this.views);
    },
    
    // Transition the new view in.
    // This is broken out as a method for convenient overriding of
    // the default transition behavior. If you only want to change the 
    // animation use the trasition class options instead.
    transitionViewIn: function(view) {
      //console.log('in', this.options);
      this.trigger('before:transitionIn', this, view);
      view.$el.addClass('hiddenToRight');
      this.$el.append(view.$el);
      
      // Wait a brief moment so it triggers the css transactions
      // If we don't delay, at least in my minimal testing, Chrome
      // does not animate the content but instead snaps-to-position.
      _.delay(function() {
        view.$el.addClass(this.options.animationClass);
        view.$el.addClass(this.options.inTransitionClass);
        _.delay(function() {
          view.$el.removeClass('hiddenToRight');
          this.trigger('transitionIn', this, view);
        }.bind(this), this.options.transitionDelay);
      }.bind(this), 1);
    },
    
    // Trastition a view out.
    // This is broken out as a method for convenient overriding of
    // the default transition behavior. If you only want to change the 
    // animation use the trasition class options instead.
    transitionViewOut: function(view) {
      this.trigger('before:transitionOut', this, view);
      view.$el.addClass(this.options.outTransitionClass);
      _.delay(function() {
        view.close();
        this.trigger('transitionOut', this, view);
        //console.log(this.views);
      }.bind(this), this.options.transitionDelay);
    }
    
  });
  
  // Define a view to show
  // ---------------------
  
  var StackViewItem = Marionette.View.extend({
    
    text: 'monkeys',
    
    randomColor: function() {
      var rc = (~~(Math.random() * 0xFFFFFF)).toString(16);
      return '#' + new Array(7 - rc.length).join('0') + rc;
    },
    
    initialize: function(options) {
      this.text = options.text;
    },
    
    render: function() {
      //console.log('stackViewItem render');
      
      this.$el.css('background-color', this.randomColor());
      
      this.$el.append($('<p>', {
        text: this.text
      }));
      return this;
    }
    
  });
  
  // Define a controller to run this module
  // --------------------------------------
  
  console.log(Marionette, Marionette.Controller);
  
  var Controller = Marionette.Controller.extend({
    
    initialize: function(options) {
      
      var self = this;
      
      this.region = options.region;
      
      
      this.listenTo(this.region, 'show', function() {
        jQuery('#add').on('click', function() {
          var v = new StackViewItem({text:'something random'});
          self.stackView.push(v);
        });
        jQuery('#remove').on('click', function() {
          self.stackView.pop();
        });
      });
    },
    
    show: function(){
      this.stackView = new StackView();
      
      var v = new StackViewItem({text:'Root View'});
      this.stackView.setRootView(v);
      
      this.listenTo(this.stackView, 'before:transitionIn', function() {
        console.log('before:transitionIn', arguments);
      });
      
      this.listenTo(this.stackView, 'transitionIn', function() {
        console.log('transitionIn', arguments);
      });
      
      this.listenTo(this.stackView, 'before:transitionOut', function() {
        console.log('before:transitionOut', arguments);
      });
      
      this.listenTo(this.stackView, 'transitionOut', function() {
        console.log('transitionOut', arguments);
      });
      
      this.region.show(this.stackView); 
    }
    
  });
  
  
  // Initialize this module when the app starts
  // ------------------------------------------
  
  Mod.addInitializer(function(){
    Mod.controller = new Controller({
      region: App.mainRegion
    });
    Mod.controller.show();
  });
});

// Start the app
// -------------

App.start();