<?php
include 'AnalizaDanychCore.php';
class AnalizaDanych extends AnalizaDanychCore {

    protected function _pobierz_porownanie($porownanie, $konfiguracja = array()) {
        switch ($porownanie) {
            case self::POROWNANIE_PLEC:
                return $this->pobierz_dane_porownanie_srednia_plec($konfiguracja);
                break;
            case self::POROWNANIE_LOKALIZACJA:
                return $this->pobierz_dane_porownanie_srednia_lokalizacja($konfiguracja);
                break;
            case self::POROWNANIE_DYSLEKSJA:
                return $this->pobierz_dane_porownanie_srednia_dysleksja($konfiguracja);
                break;
            case self::POROWNANIE_ZADANIA:
                return $this->pobierz_dane_porownanie_srednia_zadania($konfiguracja);
                break;
            case self::POROWNANIE_OBSZAR:
                return $this->pobierz_dane_porownanie_srednia_obszar($konfiguracja);
                break;
            case self::POROWNANIE_SREDNIA:
                return $this->pobierz_dane_porownanie_srednia($konfiguracja);
                break;
            default:
                return $this->pobierz_dane_porownanie_srednia_calosc($konfiguracja);
            break;
        }
    }

    public function pobierz_porownanie($get) {
        if (isset($get[AnalizaDanychCore::POROWNANIE_PLEC])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_PLEC);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_LOKALIZACJA])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_LOKALIZACJA);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_SREDNIA])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_SREDNIA);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_DYSLEKSJA])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_DYSLEKSJA);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_CALOSC])) {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_ZADANIA])) {
            $konfiguracja = array(
                    'rodzaj_danych' => !empty($get['rodzaj_danych'])? $get['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
                    'klasa' => !empty($get['klasa'])? strtoupper($get['klasa']) : 'szkola',
            );
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_ZADANIA, $konfiguracja);
        } elseif (isset($get[AnalizaDanychCore::POROWNANIE_OBSZAR])) {
            $konfiguracja = array(
                    'rodzaj_danych' => !empty($get['rodzaj_danych'])? $get['rodzaj_danych'] : AnalizaDanychCore::POROWNANIE_CALOSC,
                    'klasa' => !empty($get['klasa'])? strtoupper($get['klasa']) : 'szkola',
                    'obszar' => !empty($get['obszar'])? strtoupper($get['obszar']) : 'I',
            );
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_OBSZAR, $konfiguracja);
        } else {
            echo $this->_pobierz_porownanie(AnalizaDanychCore::POROWNANIE_CALOSC);
        }
    }

    public function pobierz_porownanie_calosc($get) {
        $dane = array();
        foreach ($this->obszary as $obszar) {
            foreach ($this->klasy as $klasa) {
                $konfig = array(
                    'klasa' => $klasa,
                    'obszar' => $obszar,
                    'rodzaj_danych' => AnalizaDanychCore::POROWNANIE_CALOSC
                );
                $dane[] = array(
                        'data' => $this->pobierz_porownanie($konfig)
                );
            }
        }
    }
    public function pobierz_dane_porownanie_srednia() {
        return $this->pobierz_dane_porownanie_srednia_calosc();
    }
    public function pobierz_dane_porownanie_srednia_calosc($konfig) {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Średnia',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable(self::POROWNANIE_CALOSC, $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_plec() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Chłopcy',
                'type' => 'number'
            ),
            array (
                'label' => 'Dziewczynki',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable(self::POROWNANIE_PLEC, $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_lokalizacja() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                'label' => 'Miasto',
                'type' => 'number'
            ),
            array (
                    'label' => 'Wieś',
                    'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable(self::POROWNANIE_LOKALIZACJA, $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_dysleksja() {
        $konfiguracja = array(
            array (
                'label' => 'Klasa',
                'type' => 'string'
            ),
            array (
                    'label' => 'Bez dysleksji',
                    'type' => 'number'
            ),
            array (
                'label' => 'Dysleksja',
                'type' => 'number'
            )
        );
        return $this->formatuj_do_datatable(self::POROWNANIE_DYSLEKSJA, $konfiguracja);
    }

    public function pobierz_dane_porownanie_srednia_obszar($konfig) {
        $konfiguracja = array(
                array (
                        'label' => 'Umiejętności dla '.$konfig['rodzaj_danych'],
                        'type' => 'string'
                ),
                array (
                        'label' => 'Średnia obszar '.$konfig['obszar'].' dla '.$konfig['klasa'],
                        'type' => 'number'
                )
        );
        if ($konfig['rodzaj_danych'] != AnalizaDanych::POROWNANIE_CALOSC) {
            $wiersz_zadanie = $this->dane_obszar[$konfig['obszar']]['calosc'][$konfig['rodzaj_danych']];
            $klucze = array_keys($wiersz_zadanie);
            $konfiguracja = array(
                    array (
                            'label' => 'Umiejętności dla '.$konfig['rodzaj_danych'],
                            'type' => 'string'
                    ),
                    array (
                            'label' => 'Średnia ('.$konfig['rodzaj_danych'].') '.$klucze[0].' obszar '.$konfig['obszar'].' dla klasy '.$konfig['klasa'],
                            'type' => 'number'
                    ),
                    array (
                            'label' => 'Średnia ('.$konfig['rodzaj_danych'].') '.$klucze[1].' obszar '.$konfig['obszar'].' dla klasy '.$konfig['klasa'],
                            'type' => 'number'
                    )
            );
        }
        return $this->formatuj_do_datatable_obszar($konfiguracja, $konfig);
    }

    public function pobierz_dane_porownanie_srednia_zadania($konfig) {
        $konfiguracja = array(
            array (
                'label' => 'Zadania',
                'type' => 'string'
            ),
            array (
                'label' => 'Średnia '.$konfig['klasa'],
                'type' => 'number'
            )
        );
        if ($konfig['rodzaj_danych'] != AnalizaDanych::POROWNANIE_CALOSC) {
            $wiersz_zadanie = $this->dane_zadania[1][$konfig['rodzaj_danych']];
            $klucze = array_keys($wiersz_zadanie);
            $konfiguracja = array(
                array (
                        'label' => 'Zadania '.$konfig['rodzaj_danych'],
                        'type' => 'string'
                ),
                array (
                        'label' => 'Średnia ('.$konfig['rodzaj_danych'].')'.$klucze[0].' dla  '.$konfig['klasa'],
                        'type' => 'number'
                ),
                array (
                        'label' => 'Średnia ('.$konfig['rodzaj_danych'].')'.$klucze[1].' dla '.$konfig['klasa'],
                        'type' => 'number'
                )
            );
        }
        return $this->formatuj_do_datatable_zadania(self::POROWNANIE_ZADANIA, $konfiguracja, $konfig);
    }
}
?>
