<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<title>About - Rashi</title>
</head>

<style>
	body {
		font-family: Arial, sans-serif;
		margin: 20px;
		padding: 20px;
		background-color: #fff;
		/* Background color */
		color: #333;
		/* Text color */
	}
	#themeToggle {
        display: none;
    }

	h1,
	h2,
	h3 {
		/* color: #007bff; */
		text-align: center;
	}

	label {
		display: block;
		margin-top: 10px;
	}

	button {
		background: #65451F;
		padding: 0.5em;
		color: white;
		border-radius: 5px;
		text-decoration: none;
		font-weight: bold;
	}

	footer {
		background-color: #65451F;
		color: #fff;
		text-align: center;
		padding: 1em 0;
	}

	header {
		background-color: #65451F;
		color: #fff;
		text-align: center;
		padding: 1em 0;
	}

	nav {
		background-color: #BCA37F;
		padding: 0.5em 1em;
		display: flex;
		position: sticky;
		top: 0;
		z-index: 2000;
	}

	nav a {
		color: #333;
		text-decoration: none;
		padding: 0 1em;
		align-self: center;
	}

	.download-button {
		background: #65451F;
		padding: 0.5em;
		color: white;
		border-radius: 5px;
		text-decoration: none;
		font-weight: bold;
	}

	.php-exploration {
		border: 1px solid #ccc;
		padding: 10px;
		background-color: #fff;
		background: #F7F1E5;
	}

	.recommendation-container {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
	}

	.recommendation {
		width: 48%;
		/* Adjust the width as needed */
		margin-bottom: 20px;
	}

	.about-container {
		display: flex;
		justify-content: space-between;
		gap: 40px;
		margin-bottom: 30px;
	}

	.image {
		border: black 2px;
		border-style: solid;
		margin-top: 50px;
		width: 30%;
		padding: 20px;
	}

	.content {
		width: 50%;
		overflow-wrap: break-word;
		padding: 20px;
		/* border-radius: 50px; */
		border: black 2px;
		border-style: solid;
		margin-top: 50px;
	}

	img {
		max-width: 100%;
		height: auto;
		margin-top: 10px;
		cursor: pointer;
		border: 1px solid #ccc;
	}
</style>

<body style="font-family: monospace; font-size: 20px">
	<?php
	include '../navbar.php'
	?>
	<header>
		<h1>Rashi's Page</h1>
	</header>

	<div class="about-container">
		<div class="image">
			<br>
			<img src="../images/meme.jpg" alt="joke" style="width:540px; height:400px">
		</div>
		<div class="content">
			<p>
				Hi! I am a 4th year Software Engineering Co-op Student Minoring in Statistics. I make really bad jokes (but they are still hilarious!).
				Case in point, I found this comic funny!
			</p>
			<br>
			<p>
				If you are struggling to figure out which show to watch next, scroll down check out some of my recommendarions depending on genre.
				Simply pick the genre that you are interested in and you will recieve a book and a show recommentation. Click on the recommendations to learn more!

			</p>
		</div>
	</div>

	<br><br>


	<section class="php-exploration">
		<h2>Not sure what to do with your free time?</h2>
		<p>
			Maybe a book or a show might intrigue you!
		</p>
		<h1>Book and Show Recommendations</h1>

		<form action="rashiPage" method="post">
			<label for="genre">Select your preferred genre:</label>
			<select id="genre" name="genre" required>
				<option value="mystery">Mystery</option>
				<option value="fantasy">Fantasy</option>
				<option value="science_fiction">Science Fiction</option>
			</select>

			<button type="submit">Get Recommendations</button>
		</form>


		<?php
		// Recommendations based on the selected genre
		$genre = $_POST["genre"];
		?>

		<h2>Recommended <?php echo ucfirst($genre); ?></h2>
		<div class="recommendation-container">
			<div class="recommendation">
				<h3>Book Recommendation</h3>
				<?php
				switch ($genre) {
					case 'mystery':
						echo "<p>'Magpie Murders' by Anthony Horowitz</p>";
						echo "<a href='https://en.wikipedia.org/wiki/Magpie_Murders'><img src='../images/mystery_book.png' alt='Magpie Murders'></a>";
						break;
					case 'fantasy':
						echo "<p>'The Hobbit' by J.R.R. Tolkien</p>";
						echo "<a href='https://en.wikipedia.org/wiki/The_Hobbit'><img src='../images/fantasy_book.png' alt='The Hobbit'></a>";
						break;
					case 'science_fiction':
						echo "<p>'Dune' by Frank Herbert</p>";
						echo "<a href='https://en.wikipedia.org/wiki/Dune_(novel)'><img src='../images/science_fiction_book.png' alt='Dune'></a>";
						break;
					default:
						echo "<img src='../images/nothing.png' alt='I got nothing meme'></a>";

						break;
				}
				?>
			</div>
			<div class="recommendation">
				<h3>Show Recommendation</h3>
				<?php
				switch ($genre) {
					case 'mystery':
						echo "<p>'Sherlock' on BBC</p>";
						echo "<a href='https://en.wikipedia.org/wiki/Sherlock_(TV_series)'><img src='../images/mystery_show.png' alt='Sherlock'></a>";
						break;
					case 'fantasy':
						echo "<p>'Game of Thrones' on HBO</p>";
						echo "<a href='https://en.wikipedia.org/wiki/Game_of_Thrones'><img src='../images/fantasy_show.png' alt='Game of Thrones'></a>";
						break;
					case 'science_fiction':
						echo "<p>'Stranger Things' on Netflix</p>";
						echo "<a href='https://en.wikipedia.org/wiki/Stranger_Things'><img src='../images/science_fiction_show.png' alt='Stranger Things'></a>";
						break;
					default:
						echo "<img src='../images/nothing.png' alt='I got nothing meme'></a>";
						break;
				}
				?>
			</div>
		</div>
	</section>


</body>

<?php
include '../footer.php'
?>

</html>