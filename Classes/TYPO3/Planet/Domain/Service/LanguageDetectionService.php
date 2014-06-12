<?php

namespace TYPO3\Planet\Domain\Service;


use TYPO3\Flow\Annotations as Flow;

/**
 * A service to sync feeds from channels
 *
 * @Flow\Scope("singleton")
 */
class LanguageDetectionService {
	/**
	 * @var \LanguageDetector\Detect
	 */
	protected $detector = NULL;

	public function detect($string) {
		$return = 'unknown';
		$this->initDetect();
		try {
			$language = $this->detector->detect($string);
			if(is_string($language)) {
				$return = $language;
			}
		} catch(\Exception $e) {
		}
		return $return;
	}

	public function initDetect() {
		if($this->detector !== NULL) {
			return;
		}
		$dataFile = FLOW_PATH_DATA . 'languageDetectorDataFile.php';
		if(!is_file($dataFile)) {
			throw new \Exception('Problem reading language data in:' . $dataFile);
			return;
		}
		$this->detector = \LanguageDetector\Detect::initByPath($dataFile);
	}

	public function learnFromSamples() {
		ini_set('memory_limit', '2G');
		$config  = new \LanguageDetector\Config;
		$learner = new \LanguageDetector\Learn($config);
		foreach (glob(FLOW_PATH_PACKAGES . 'Libraries/crodas/languagedetector/example/samples/*') as $file) {
			// feed with examples ('language', 'text');
			$learner->addSample(basename($file), file_get_contents($file));
		}
		$learner->addStepCallback(function($lang, $status) {
			echo "Learning {$lang}: $status\n";
		});
		$learner->save(\LanguageDetector\AbstractFormat::initFormatByPath(FLOW_PATH_DATA . 'languageDetectorDataFile.php'));

		unset($this->detector);
	}
} 