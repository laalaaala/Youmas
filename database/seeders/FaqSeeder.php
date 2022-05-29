<?php

namespace Database\Seeders;

use App\Models\Faq;
use Faker\Factory;
use Faqs;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'title' => "1. Wie registriere ich mich?",
            'content' => "Die Registrierung ist ganz einfach. Klicke auf den „Registrieren“-Button und wähle aus, ob du ein Kunden- oder Partner-Konto anlegen möchtest. Nachdem du deine Informationen eingegeben hast, erhältst du eine Bestätigungsmail und bist startklar!"
        ]);

        Faq::create([
            'title' => "2. Wie finde ich mein gewünschtes Studio?",
            'content' => "Du gibst in der Suche deine Stadt oder PLZ ein und wählst die Dienstleistung, nach der du suchst. Du erhältst daraufhin sofort die besten Ergebnisse und kannst einen Termin buchen."
        ]);

        Faq::create([
            'title' => "3. Wie buche ich einen Termin bei dem gewünschten Dienstleister?",
            'content' => "Nach der Auswahl des Dienstleisters gibst du dein Wunschdatum und -uhrzeit an. Falls der Dienstleister es anbietet, kannst du eine spezielle Person in dem Salon / Studio buchen."
        ]);

        Faq::create([
            'title' => "4. Welche Zahlungsarten gibt es?",
            'content' => "Bei der Buchung hast du die Möglichkeit die Zahlung sofort über einen Dritt-Anbieter vorzunehmen. Oder du wählst die Barzahlung und zahlst bei deinem Termin. Aktuell stehen folgende Zahlungsanbieter zur Verfügung: PayPal, SOFORT-Überweisung, Giropay, Apple Pay, Google Pay."
        ]);

        Faq::create([
            'title' => "5. Wie funktioniert eine Termin-Stornierung?",
            'content' => "Du loggst dich ein und wählst im Profil den Menüpunkt „Buchungen“. Hier siehst du alle gebuchten Termine und kannst den Termin auswählen, den du stornieren möchtest. Mit einem Klick auf den „Stornieren“-Button erhältst du eine Bestätigungsmail. Nach der Bestätigung wird dein Termin storniert."
        ]);
        
        Faq::create([
            'title' => "6. Wann erhalte ich nach einer Stornierung mein Geld zurückerstattet?",
            'content' => "Dein Geld bekommst du auf dem selben weg zurück wie du gebucht hast. Das kann aber bis zu 7 Tage in anspruch nehmen aber im Regelfall sind es 2-3 Werktage. <br /> In der Regel erhältst du die Rückerstattung innerhalb von 2-3 Werktagen, in Einzelfällen kann die Rückerstattung auch bis zu 7 Werktage dauern. Du erhältst das Geld auf demselben Zahlungsweg erstattet, den du zur Buchung verwendet hast."
        ]);
    }
}
