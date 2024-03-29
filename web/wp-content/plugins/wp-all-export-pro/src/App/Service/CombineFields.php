<?php

namespace Wpae\App\Service;


use Wpae\App\Service\SnippetParser;

class CombineFields
{
    const DOUBLEQUOTES = "**DOUBLEQUOTES**";

    /** @var  SnippetParser */
    private $snippetParset;

    public function __construct()
    {
        $this->snippetParset = new SnippetParser();
    }

    /**
     * @param $functions
     * @param $combineMultipleFieldsValue
     * @param $articleData
     * @return string
     * @internal param $snippetParser
     */
    public static function prepareMultipleFieldsValue($functions, $combineMultipleFieldsValue, $articleData)
    {
        $combineFields = new CombineFields();

        foreach ($functions as $key => $function) {
            if (!empty($function)) {

                $originalFunction = $function;

                $function = str_replace('**OPENARR**', '[', $function);
                $function = str_replace('**CLOSEARR**', ']', $function);

                // Quick fix for refund id missing and not replaced in functions
                if(strpos($function, "{Refund ID}") !== false ) {
                    $function = str_replace("{Refund ID}","null", $function);
                }

                if(strpos($function, '{Rate Code (per tax)}')) {
                    $function = str_replace('{Rate Code (per tax)}', '$articleData[\'Rate Code\']', $function);
                }

                if(strpos($function, '{Term ID}')) {
                    $function = str_replace('{Term ID}', '$articleData[\'Term ID\']', $function);
                }

                $function = preg_replace('/\{(.*?)\}/i', "''", $function);

	            try {
		            $combineMultipleFieldsValue = str_replace('[' . $originalFunction. ']', eval('return '.$function.';'), $combineMultipleFieldsValue);
	            }catch( \Throwable $e ){
					// If WP_DEBUG is true then log the errors. Otherwise just ignore them as it's probably just exported data related.
		            if( defined('WP_DEBUG') && WP_DEBUG ) {
			            $identifier = date( 'Y-m-d H:i:s' ) . ' WP All Export user provided function failure: ';
			            error_log( $identifier . $e->getMessage() );
			            error_log( $identifier . $e->getTraceAsString() );
		            }

	            }



            }
        }

        foreach ($articleData as $key => $vl) {
            $combineMultipleFieldsValue = str_replace('{' . $key . '}', str_replace(self::DOUBLEQUOTES, "\"", $vl), $combineMultipleFieldsValue);
        }

        $snippets = $combineFields->snippetParset->parseSnippets($combineMultipleFieldsValue);

        // Replace empty snippets with empty string
        foreach ($snippets as $snippet) {
            $combineMultipleFieldsValue = str_replace('{'.$snippet.'}', '', $combineMultipleFieldsValue);
        }
        return $combineMultipleFieldsValue;
    }
}