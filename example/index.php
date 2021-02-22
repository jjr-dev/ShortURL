<?php require_once('php/header.php'); ?>

	<div class="container text-center pt-5 pb-3">
		<div class="row">
			<div class="col-12">
				<h1>🔗shortURL</h1>
				<p>Encurtador de URL em PHP sem banco de dados com URL personalizada e aleatória.</p>
				<div class="alert alert-danger">
					<b>Aviso:</b>
					<br>
					<p>Esse é apenas um ambiente de testes e a URL Encurtada é apenas para exemplo, não estará muito curta por conta dos diretórios existentes.</p>
					<p>Se colocado em um servidor em produção, o resultado será algo como <u>https://example.com/s/uhd23</u></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<form id="shortUrlForm">
						<h2 class="mb-4">Gerar URL encurtada</h2>
						<div class="form-group">
							<label for="shortUrl">URL original</label>
							<input type="text" class="form-control width-config" id="shortUrl" name="shortUrl" style="margin: 0 auto" placeholder="URL longa que deseja encurtar">
						</div>
						<div class="form-group">
							<label for="customUrl">URL personalizada (opcional)</label>
							<input type="text" class="form-control width-config" id="customUrl" name="customUrl" style="margin: 0 auto" placeholder="Personalização da URL encurtada">
						</div>
						<button class="btn btn-primary width-config">
							Encurtar
						</button>
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<form id="infosUrlForm">
						<h2 class="mb-4">Dados da URL encurtada</h2>
						<div class="form-group">
							<label for="infosUrl">URL encurtada</label>
							<input type="text" class="form-control width-config" id="infosUrl" name="infosUrl" style="margin: 0 auto" placeholder="URL curta que deseja encontrar os dados">
						</div>
						<button class="btn btn-primary width-config">
							Ver dados
						</button>
					</form>
				</div>	
			</div>
			<div class="col-12">
				<div class="alert alert-success mt-3 box-infosUrl" style="margin: 0 auto; display: none;">
					<b>URL Encurtada:</b><br>
					<span class="short"></span>
					<br>
					<br>
					<b>URL Original:</b><br>
					<span class="date"></span>
					<br>
					<br>
					<b>Data de criação:</b><br>
					<span class="date"></span>
					<br>
					<br>
					<b>Acessos:</b><br>
					<span class="count"></span>
				</div>

				<div class="alert alert-success mt-3 box-shortUrl" style="margin: 0 auto; display: none;">
					<b>URL Encurtada:</b><br>
					<span class="short"></span>
					<br>
					<br>
					<b>URL Original:</b><br>
					<span class="origin"></span>
				</div>

				<div class="alert alert-danger mt-3 box-error" style="margin: 0 auto; display: none;">
					<b>Ocorreu um erro:</b><br>
					<span class="erro"></span>
				</div>

				<div class="mt-5 pt-2 mb-5">
					<h1 class="bye">👋</h1>
					<br>
					<b>Desenvolvido por:</b> <a href="https://github.com/JulimarJunior" target="_blank">Julimar Junior</a>
					<br>
					<br>
					<a href="https://github.com/JulimarJunior/ShortURL" target="_blank"><b>Ver repositório no GitHub</b></a>
				</div>
			</div>
		</div>
	</div>

<?php require_once('php/footer.php'); ?>