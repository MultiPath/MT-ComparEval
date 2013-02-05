<?php

class ExperimentsListContext extends BasePageContext {

	/**
	 * @When /^I open page with experiments list$/
	 */
	public function iOpenPageWithExperimentsList() {
		$this->openPage( 'experiments list' );
	}
	
	/**
	 * @Then /^I should see "([^"]*)" in the experiments list$/
	 */
	public function iShouldSeeInTheExperimentsList( $experimentName ) {
		$uploadedExperiments = $this->page->getExperimentsNames();

		$this->assert(
			in_array( $experimentName, $uploadedExperiments ),
			'Uploaded experiment is not in list'
		);
	}

	/**
	 * @Given /^I click on sentences link of "([^"]*)"$/
	 */
	public function iClickOnSentencesLinkOf( $experimentName ) {
		$this->page->goToExperimentsSentences( $experimentName );

		$this->getSession()->wait(200);
		$this->page = new SentencesListPage( $this->getSession()->getPage() );
	}

	/**
	 * @Then /^I should see source and reference sentences of "([^"]*)"$/
	 */
	public function iShouldSeeSourceAndReferenceSentencesOf( $experimentName ) {
		$sentences = $this->page->getSentences();
		$this->assert(
			count( $sentences ) > 0,
			'No source/reference sentence is available'
		);
	}

	public function openPage( $view ) {
		switch( $view ) {
			case 'experiments list':
				$this->getSession()->visit( $this->getUrl( '/' ) );
				break;
		}

		$this->getSession()->wait(200);

		$this->page = new ExperimentsListPage( $this->getSession()->getPage() );
	}


}

