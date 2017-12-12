<?php
    session_start();
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Formulaire de demande de documents </title>
		<!-- call bootstrap -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<hr>
					<div class="alert alert-info text-center">
						<h1>
							<b>Demande de documents (pour anciens étudiants)</b>
						</h1>
						<div class="alert alert-warning">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							Les champs marqués par une <span style="color:#777777;" class="glyphicon glyphicon-asterisk"></span> sont obligatoires.
						</div>
					</div>
					<div>
						<?php
						if(array_key_exists('errors', $_SESSION)):
						?>
							<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?= implode('<br>', $_SESSION['errors']); ?>
							</div>
						<?php
						endif;
						?>
					
						<?php
						if(array_key_exists('success', $_SESSION)):
							?>
							<div class="alert alert-success text-center">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<h1><b><span class="glyphicon glyphicon-ok"></span> Les informations que vous nous avez communiquées nous sont bien parvenues.<br />
								Merci<br /></b></h1>
							</div>
						<?php
						endif;
						?>
					</div>
					<form class="form-horizontal" method="post" action="send-attestations.php">
						<div class="form-group">
							<label class="control-label col-sm-2" for="nom">Nom :<span style="color:#777777;" class="glyphicon glyphicon-asterisk"></span></label>
							<div class="col-sm-4">
								<input required type="text" class="form-control input-lg" id="nom" placeholder="Votre NOM" name="nom" value="<?= isset($_SESSION['inputs']['nom']) ? $_SESSION['inputs']['nom'] : ''; ?>">
							</div>
							<label class="control-label col-sm-2" for="prenom">Prénom :<span style="color:#777777;" class="glyphicon glyphicon-asterisk"></span></label>
							<div class="col-sm-3">
								<input required type="text" class="form-control input-lg" id="prenom" placeholder="Votre Prénom" name="prenom" value="<?= isset($_SESSION['inputs']['prenom']) ? $_SESSION['inputs']['prenom'] : ''; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="dn">Date de naissance :<span style="color:#777777;" class="glyphicon glyphicon-asterisk"></span></label>
							<div class="col-sm-4">
								<div class="input-group">
									<span class="input-group-addon"><i><b>DU</b></i></span>
									<input required type="date" class="form-control input-lg" id="debut" placeholder="JJ/MM/AAAA" name="debut" value="<?= isset($_SESSION['inputs']['debut']) ? $_SESSION['inputs']['debut'] : ''; ?>">
								</div>
							</div>
						<div class="col-sm-5">
							<div class="input-group">
								<span class="input-group-addon"><i><b>AU</b></i></span>
								<input required type="date" class="form-control input-lg" id="fin" placeholder="JJ/MM/AAAA" name="fin" value="<?= isset($_SESSION['inputs']['fin']) ? $_SESSION['inputs']['fin'] : ''; ?>">
								<span class="input-group-addon"><b>INCLUS</b></span>
							</div>
						</div>
						</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="nom">Implantation(s) :<span style="color:#777777;" class="glyphicon glyphicon-asterisk"></span></label>
							<div class="col-sm-4">
								<label for="bruxelles" class="btn btn-info btn-lg btn-block"><B> BRUXELLES </B><input type="checkbox" id="bruxelles" name="bruxelles" value="Bruxelles" class="badgebox"></label>
							</div>
							<div class="col-sm-1">
								<p class="form-control-static"><b>et/ou</b></p>
							</div>
							<div class="col-sm-4">
								<label for="jodoigne" class="btn btn-info btn-lg btn-block"><B> JODOIGNE </B><input type="checkbox" id="jodoigne" name="jodoigne" value="Jodoigne" class="badgebox"></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="commentaires">Commentaires :</label>
							<div class="col-sm-9">
								<textarea class="form-control input-lg" rows="4" id="commentaires" placeholder="Indiquez ici toutes les informations complémentaires, remarques, ..." name="commentaires"><?= isset($_SESSION['inputs']['commentaires']) ? $_SESSION['inputs']['commentaires'] : ''; ?></textarea>
							</div>
						</div>
				
						
						<!-- <div class="form-group">
							<div class="col-sm-1"></div>
							<label class="control-label col-sm-2" for="pj">Pièce jointe :</label>
							<div class="col-sm-8">
							<input class="btn btn-info btn-lg btn-block" type="file" name="pj" id="pj" /><br />
							</div>
						</div> -->
				
						<div class="form-group">
							<div class="col-sm-3">
							</div>
							<div class="col-sm-3">
								<button type="submit" class="btn btn-info btn-lg btn-block" value="submit" name="submit" id="submit"><b>Envoyer</b></button>
							</div>
							<div class="col-sm-1">
							</div>
							<div class="col-sm-3">
								<button type="reset" class="btn btn-default btn-lg btn-block">Recommencer</button>
							</div>
							<div class="col-sm-2">
							</div>
						</div>
					</form>
					<!-- <h1>Page absences hors service pour le moment</h1>
					<p>Nous mettons tout en oeuvre afin de rétablir cette page le plus rapidement possible.<br />
					Merci de nous signaler vos absences en envoyant un email à <a href="mailto:absences@cnldb.be?Subject=Un%20enseignant%20a%20signalé(e)%20son%20absence">absences@cnldb.be</a></p> -->
				</div>
			</div>
		</div>
	</body>
</html>

<?php
unset($_SESSION['inputs']);
unset($_SESSION['success']);
unset($_SESSION['errors']);
?>
