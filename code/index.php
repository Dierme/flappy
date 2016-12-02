<?php
require_once(__DIR__ . '/client/GitHubClient.php');
require_once(__DIR__ . '/utility.php');
require_once(__DIR__ . '/config.php');


$issueNumb = 1;
$comment = 'comment4';
$programm = new Utility($username, $password, $ownersFilePath);
//$programm->addComment($owner, $repo, $issueNumb, $comment);
//$issues = $programm->getIssues($owner, $repo);
//$issues = $programm->getPullRequests($owner, $repo);
$files = $programm->listPullRequestsFiles($owner, $repo, 1);
print_r($files);
//print_r($programm->getOwners());












//$username = 'Dierme';
//$password = 'ggitthhubb1';
//$client = new GitHubClient();
//$client->setCredentials($username, $password);
//
//
//$owner = 'dierme';
//$repo = 'flappy';
//$client->setPage();
//$client->setPageSize(2);
//$commits = $client->repos->commits->listCommitsOnRepository($owner, $repo);
//
////print_r($commits);
//
//echo "Count: " . count($commits) . "\n";
//foreach($commits as $commit)
//{
//    /* @var $commit GitHubCommit */
//    echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
//}
//
//$commits = $client->getNextPage();
//
//echo "Count: " . count($commits) . "\n";
//foreach($commits as $commit)
//{
//    /* @var $commit GitHubCommit */
//    echo get_class($commit) . " - Sha: " . $commit->getSha() . "\n";
//}
//
//echo "<br>";
//echo "<br>";
//$issueNumb = 1;
//$gitHubIssue = new GitHubIssues($client);
//$issues = $gitHubIssue->comments->listCommentsOnAnIssue($owner, $repo, $issueNumb);
////print_r($issues);
//foreach($issues as $issue)
//{
//    /* @var $commit GitHubCommit */
//     echo get_class($issue) ." " . $issue->getBody() . "\n";
//}
//$body = 'comment2';
//$gitHubIssue->comments->createComment($owner, $repo, $issueNumb, $body);
//
//echo "<br>";
//echo "<br>";



?>  