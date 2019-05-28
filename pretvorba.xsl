<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
		<html lang="hr">
			<head>
				<link rel="stylesheet" href="dizajn.css"/>
				<meta charset="UTF-8"/>
				<title>Najljepše biciklističke destinacije svijeta</title>
			</head>

			<body>
				<div id="header">
					<h1><em>Najljepše biciklističke destinacije svijeta</em></h1>
					<br/>
					<a href="index.html">
						<div id="poc">
							<img class="bottom" src ="pocetna1.jpg" alt="Pocetna"/>
							<img class="top" src="pocetna2.jpg" alt="Pocetna"/>
						</div><br/>
					</a>
				</div>

				<div id="content">
					<nav>
						<ul class="item">
							<li><a href="index.html">Početna stranica</a></li>
							<li><a href="obrazac.html">Stranica za pretraživanje</a></li>
							<li><a href="https://www.fer.unizg.hr/predmet/or">Službena stranica kolegija Otvoreno računarstvo</a></li>
							<li><a href="https://www.fer.unizg.hr/" target="_blank">Službena stranica FER-a</a></li>
							<li><a href="mailto:nina.zuccon@fer.hr">e-pošta autora</a></li>
							<li><a href="podaci.xml">Podaci</a></li>
						</ul>
					</nav>

					<section id="uvod">
						<table id="podaci">
							<tr>
								<th>Država</th>
								<th>Ime staze</th>
								<th>Klima</th>
								<th>Smještaj staze</th>
								<th>Vrsta staze</th>
								<th>Težina staze</th>
								<th>Nadmorska visina</th>
								<th>Kilometraža</th>
							</tr>
						<xsl:for-each select="podaci/destinacija">
							<tr>
								<td><xsl:value-of select="@drzava"/></td>
								<td><xsl:value-of select="staza/@ime_staze"/></td>
								<td><xsl:value-of select="staza/@klima"/></td>
								<td><xsl:value-of select="staza/@smjestaj_staze"/></td>
								<td><xsl:for-each select="staza/vrsta_staze/*">
									<xsl:value-of select="name(.)"/>&#160;	
								</xsl:for-each>
								</td>
								<td><xsl:for-each select="staza/tezina_staze/*">
									<xsl:value-of select="name(.)"/>&#160;	
								</xsl:for-each>
								</td>		
								<td><xsl:value-of select="staza/@nadmorska_visina"/></td>
								<td><xsl:value-of select="staza/@kilometraza"/></td>	
							</tr>
			
						</xsl:for-each>
						</table>
					</section>
				</div>

				<div id="footer">
					<p id="pp">Nina Zuccon</p>
					<img src="logo.jpg" alt="logo" height="70" width="70"/>
				</div>
			</body>
		</html>		
	</xsl:template>
</xsl:stylesheet>