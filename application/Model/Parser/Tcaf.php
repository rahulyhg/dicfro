<?php

/**
 * Dicfro
 *
 * PHP 5
 *
 * @category   DicFro
 * @package    Model
 * @subpackage Parser
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2013 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'Model/Parser.php';

/**
 * Parser of the Conjugation Tables
 *
 * @category   DicFro
 * @package    Model
 * @subpackage Parser
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2013 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class Model_Parser_Tcaf extends Model_Parser
{
    const LINE_TPL = '~^(.+?) +\[(inf.|ind.prés.|subj.prés.|impé.|ind.impf.|part.prés.|futur|cond.|pass.simp.|pass.arch.|subj.impf.|part.pass.|comp.)\]__BR____BR__ +(.+?)__BR__$~';
    const FORM_SEPARATOR = '__BR__   ';
    const FORM_TPL = '~^(\d): (.+)$~';
    const VERB_SEPARATOR = ' *[,;] *';

    public $batchFiles = ['entry.sql', 'word.sql'];
    public $dataFiles = ['entry' => 'entry.txt', 'word' => 'word.txt'];

    public function checkVerbs($verbs, $lineNumber)
    {
        foreach($verbs as $verb) {
            if (preg_match('~\d~', $verb)) {
                $this->error('verb shoud not contain digits: ' . $this->string->utf8ToInternal($verb), true, $lineNumber);
            }
        }
    }

    public function parseForm($form, $lineNumber)
    {
        if (preg_match(self::FORM_TPL, $form, $match)) {
            list(, $person, $verbs) = $match;
        } else {
            $person = '';
            $verbs = $form;
        }

        return [$person, $this->parseVerbs($verbs, $lineNumber)];
    }

    public function parseLine($line, $lineNumber)
    {
        // trims the line
        $line = trim($line);

        if (!$line) {
            // ignores empty lines or comments
            return [];
        }

        if (! preg_match(self::LINE_TPL, $line, $matches)) {
            // extracts word
            $this->error('wrong format: ' . $this->string->utf8ToInternal($line), true, $lineNumber);
        }

        list(, $infinitive, $tense, $conjugation) = $matches;

        return [
            'entry' => $this->setEntryData($infinitive, $tense, $conjugation, $lineNumber),
            'word'  => $this->setWordsData($infinitive, $tense, $conjugation, $lineNumber),
        ];
    }

    public function parseVerbs($verbs, $lineNumber)
    {
        // removes variants data
        $verbs = str_replace('(', ',', $verbs);
        $verbs = str_replace('VAR.', '', $verbs);
        $verbs = str_replace(')', '', $verbs);

        $verbs = preg_split(self::VERB_SEPARATOR, $verbs, -1, PREG_SPLIT_NO_EMPTY);
        $this->checkVerbs($verbs, $lineNumber);

        return $verbs;
    }

    public function setInfinitiveAscii($infinitive)
    {
        // removes extra-data from verb, ex. "FÖIR (fouir)"
        list($ascii) = explode(' ', $infinitive);

        return $this->string->utf8toASCII($ascii);
    }

    public function setEntryData($infinitive, $tense, $forms, $lineNumber)
    {
        $entryData = [
            'ascii'       => $this->setInfinitiveAscii($infinitive),
            'original'    => $infinitive,
            'tense'       => $tense,
            'conjugation' => str_replace('__BR__   ', '<br />', $forms),
            'line'        => $lineNumber,
            ];

        ksort($entryData);

        return implode('|', $entryData);
    }

    public function setWordData($infinitive, $tense, $form, $lineNumber)
    {
        list($person, $verbs) = $form;

        $wordsData = [];

        foreach($verbs as $verb) {
            $wordData = [
                'ascii'            => $this->string->utf8toASCII($verb),
                'original'         => $verb,
                'person'           => $person,
                'infinitive'       => $infinitive,
                'infinitive_ascii' => $this->setInfinitiveAscii($infinitive),
                'tense'            => $tense,
                'line'             => $lineNumber,
                'composed'         => (int)($tense == 'comp.' and !strpos($verb, '*')),
            ];

            ksort($wordData);

            $wordsData[] = implode('|', $wordData);
        }

        return $wordsData;
    }

    public function setWordsData($infinitive, $tense, $conjugation, $lineNumber)
    {
        $forms = explode(self::FORM_SEPARATOR, $conjugation);
        $wordsData = [];

        foreach($forms as $form) {
            $form = $this->parseForm($form, $lineNumber);
            $wordsData = array_merge($wordsData, $this->setWordData($infinitive, $tense, $form, $lineNumber));
        }

        return implode("\n", $wordsData);
    }
}