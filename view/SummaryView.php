<?php

class SummaryView {
    
    /*
        Handles the content for showing summary.
    */
    
    private static $addResultPage = 'addresultpage';
    private $userCatalogue;
	
	public function __construct(UserCatalogue $userCatalogue) {
        $this->userCatalogue = $userCatalogue;
    }
    
    public function response() {
        return $this->generateSummaryList();
	}
	
	private function generateSummaryList() {
		$ret = '';
        $currentUser = $this->userCatalogue->getCurrentUser();
        $exercises = $this->userCatalogue->getExercises($currentUser);
        
        if(!empty($exercises)) {
            uasort($exercises, function($a, $b) { return strcmp($a->getName(), $b->getName()); } );
            
            foreach($exercises as $exercise) {
		        $results = $exercise->getResults();
		        if(!empty($results)) {
			        uasort($results, function($a, $b) { return strcmp($a->getDateStamp(), $b->getDateStamp()); } );
			        $results = array_reverse($results);
			        $latestResultText = $results[0]->getText();
			        $latestResultDateStamp = $results[0]->getDateStamp();
			        $ret .= '<a class="summarylinks" href="?'. self::$addResultPage . '=' . $exercise->getId() . '"><p class="summary">' . $exercise->getName() . '</a> : ' . 
                    '<span class="latestresult">' . $latestResultText . '</span>' . ' - ' . '<span class="datestamp">' . $latestResultDateStamp . '</span></p>';
		        }
            }
        }
        return $ret;
	}

    //Getters and setters for the private membervariables.
	
	public function isAddResultPageSet() {
		return isset($_GET[self::$addResultPage]);
    }
}