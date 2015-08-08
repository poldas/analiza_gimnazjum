<?php
interface AnalizaDanychSql {

    const POROWNANIE_CALOSC = 'calosc';
    const POROWNANIE_PLEC = "plec";
    const POROWNANIE_LOKALIZACJA = "lokalizacja";
    const POROWNANIE_DYSLEKSJA = "dysleksja";

    const SQL_LATWOSC_KLASA_ZADANIE = "
        select
            we.klasa,
            we.nr_zadania,
            sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow
        from wyniki_egzaminu as we
        group by we.nr_zadania, we.klasa
    ";

    const SQL_LATWOSC_SZKOLA_ZADANIE = "
        select
            we.nr_zadania,
            sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow
        from wyniki_egzaminu as we
        group by we.nr_zadania
    ";

    const SQL_LATWOSC_SZKOLA_MIEJSCOWOSC = "
        select
            we.nr_zadania,
            sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow
            u.miejscowosc
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.miejscowosc
    ";

    const SQL_LATWOSC_SZKOLA_DYSLEKSJA  = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.dysleksja
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.dysleksja
    ";

    const SQL_LATWOSC_SZKOLA_PLEC = "
        select
            we.nr_zadania,
            avg(we.liczba_punktow) as we.srednia_punktow,
            u.plec
        from wyniki_egzaminu as we
        left join uczniowie as u
            on u.kod_ucznia = we.kod_ucznia
        group by we.nr_zadania, u.plec
    ";

    const UNION_ALL_SREDNIA = "
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                null dysleksja,
                null lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                null dysleksja,
                null lokalizacja,
                null plec,
                u.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP by u.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                u.dysleksja,
                null lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.dysleksja
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                null dysleksja,
                u.lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.lokalizacja
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                null dysleksja,
                null lokalizacja,
                u.plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.plec
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                u.dysleksja,
                null lokalizacja,
                null plec,
                we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.dysleksja, we.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                null dysleksja,
                u.lokalizacja,
                null plec,
                we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.lokalizacja, we.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow, null dysleksja, null lokalizacja, u.plec, we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY u.plec, we.klasa";

    const UNION_ALL_SREDNIA_ZADANIA = "
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                null lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                null lokalizacja,
                null plec,
                u.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP by we.nr_zadania, u.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                u.dysleksja,
                null lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.dysleksja
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                u.lokalizacja,
                null plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.lokalizacja
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                null lokalizacja,
                u.plec,
                'szkola' klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.plec
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                u.dysleksja,
                null lokalizacja,
                null plec,
                we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.dysleksja, we.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                u.lokalizacja,
                null plec,
                we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.lokalizacja, we.klasa
            UNION
            select sum(we.liczba_punktow)/sum(we.max_punktow) as srednia_punktow,
                we.nr_zadania,
                null dysleksja,
                null lokalizacja,
                u.plec,
                we.klasa
            from wyniki_egzaminu as we
            left join uczniowie as u
                on u.kod_ucznia = we.kod_ucznia
            GROUP BY we.nr_zadania, u.plec, we.klasa";
}
?>
