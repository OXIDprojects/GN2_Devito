# Systemvoraussetzungen

OXID eShop >4.6, PHP+GD, PHP5.


# Installation

um gn2_devito zu installieren muss man nur den Modulordner in /modules hochladen und im OXID-Backend das Modul aktivieren.


# Anwendungsbeispiel

Nach der Installation steht eine neue Smarty-Funktion zur Verf�gung: [{devito}], die eine Bild-URL und verschiedene Parameter annimt. Ausgegeben wird eine Bild-URL, die automatisch das Bild mit den angegebenen Einstellungen skaliert.

    [{devito src=$product->getMasterZoomPictureUrl(1) settings="w:500;h:200;zc:1;"}]

CSS-Syntax wird f�r den Settings-Paramter verwendet. z.B. key=value; Settings, die h�ufig benutzt werden k�nnen auch in /modules/gn2_devito/presets.php ausgelagert werden. In dem Fall wird der Settings Parameter nicht angegeben:


    GN2_Devito_Tools::$presets = array(
        'details' => 'w:500;h:200;',
        'list'    => 'w:300;h:500;',
    );


    [{devito src=$product->getMasterZoomPictureUrl(1) preset="list"}]


# Parameter

Im Hintergrund wird die TimThumb Klasse angesprochen (http://code.google.com/p/timthumb/). Alle TimThumb-Parameter k�nnen als Settings angegeben werden.

Siehe: http://www.binarymoon.co.uk/2012/02/complete-timthumb-parameters-guide/

*Bitte beachten:* es muss unbedingt die CSS-Syntax verwendet werden. z.B. ?w=500&h=200&zc=1 wird als settings="w=500;h=200;zc=1" geschrieben.











