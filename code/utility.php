<?php
require_once(__DIR__ . '/client/GitHubClient.php');


class Utility{
    protected $username;
    protected $password;
	protected $owners;
    public $client;
    
    public function __construct($username, $password, $ownersFilePath)
	{
		$this->username = $username;
		$this->password = $password;
        $this->client = new GitHubClient();
        $this->client->setCredentials($username, $password);
		$this->owners = $this->parseOwners($ownersFilePath);
	}
    
    public function addComment($owner, $repo, $issueNumb, $body){
        $gitHubIssue = new GitHubIssues($this->client);
        $gitHubIssue->comments->createComment($owner, $repo, $issueNumb, $body);
		return true;
    }
	
	
	public function getIssues($owner, $repo){
		$gitHubIssue = new GitHubIssues($this->client);
        $issues = $gitHubIssue->listIssues($owner,$repo);
		
		$result = array();
		
		foreach ($issues as $issue)
		{
			$result[] = array('id'=>$issue->getNumber(), 'title'=>$issue->getTitle());
		}
		return $result;
	}
	
	
	public function getPullRequests($owner, $repo){
		$gitHubIssue = new GitHubPulls($this->client);
        $pulls = $gitHubIssue->listPullRequests($owner,$repo);
		
		$result = array();
		
		foreach ($pulls as $pull)
		{
			$result[] = array('id'=>$pull->getNumber(), 'title'=>$pull->getTitle());
		}
		return $result;
	}
	
	public function listPullRequestsFiles($owner, $repo, $pullID){
		$gitHubIssue = new GitHubPulls($this->client);
        $files = $gitHubIssue->listPullRequestsFiles($owner,$repo, $pullID);
		
		$result = array();
		
		foreach ($files as $file)
		{
			$result[] = array('number'=>1, 'title'=>$file->getFilename());
		}
		return $result;
	}
			
	
	public function getOwners(){
		return $this->owners;
	}
	
	public function parseOwners($ownersFilePath){
		$ownersLines = file($ownersFilePath);
		$owners = array();
		foreach($ownersLines as $line){
			$owner = array();
			$ownerTemp = explode(':',$line);
			
			$filePath = $ownerTemp[0];
			$ownerName = explode('@',$ownerTemp[1])[0];
			$ownerCategory = explode('@',$ownerTemp[1])[1];
			
			$owners[$ownerName]['files'][] = $filePath;
			
			//one user may be solo developer and a team member
			if( array_key_exists('category', $owners[$ownerName]) ){
				if( !in_array($ownerCategory, $owners[$ownerName]['category']) ){
					$owners[$ownerName]['category'][] = $ownerCategory;
				}
			}
			else{
				$owners[$ownerName]['category'][] = $ownerCategory;
			}
		}
		return $owners;
	}
	
	public function changedFilesOwners(){
		
	}
    
}