<?
// open a session (save load time on reading in all files)
  session_start();
  header("Cache-control: private"); // IE 6 Fix.

    session_destroy();
    session_start();

	if (isset($_COOKIE['DVDAdmin']))
	{
		setcookie ("DVDAdmin", "", time() - 3600);

	}

	echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=index.php">';
?>