<html lang="hr" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<?php

$dom = new DOMDocument();
$dom->load("podaci.xml");

$xp = new DOMXPath($dom);
$destinacija = $xp->query("/podaci/destinacija");
$staza = $xp->query("/podaci/destinacija/staza");
$okolica = $xp->query("/podaci/destinacija/okolica_staze");

if(isset($_REQUEST['drzava'])) $drzava = $_REQUEST['drzava'];
if(isset($_REQUEST['ime_staze'])) $imestaze = $_REQUEST['ime_staze'];
if(isset($_REQUEST['klima'])) $radioklima = $_REQUEST["klima"];
if(isset($_REQUEST['smjestaj_staze'])) $radiosmjestaj = $_REQUEST["smjestaj_staze"];
if(isset($_REQUEST['vrsta_staze'])) $checkvrsta = $_REQUEST["vrsta_staze"];
if(isset($_REQUEST['tezina_staze'])) $checktezina = $_REQUEST["tezina_staze"];
if(isset($_REQUEST['nadmorska'])) $nadmorska = $_REQUEST['nadmorska'];
if(isset($_REQUEST['kilometraza'])) $kilometraza = $_REQUEST['kilometraza'];
if(!empty($_REQUEST['aktivnost'])) $selectaktivnost = $_REQUEST['aktivnost'];

include ('funkcije.php');
?>

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
								<th>Vrsta staze</th>
								<th>Težina staze</th>
								<th>Kilometraža</th>
                                <th>Aktivnost</th>
							</tr>
							<tr>
								<?php
									$rezdrzava = array();
									if(!empty($_REQUEST['drzava'])) {
										$rezdrzava = validirajDrzavu($destinacija, $drzava);
									} else {
										$rezdrzava = array("1", "2", "3", "4", "5");
									}
									
									$rezime = array();
									if(!empty($_REQUEST['ime_staze'])) {
										$rezime = validirajImeStaze($staza, $imestaze);
									} else {
										$rezime = array("1", "2", "3", "4", "5");
									}
									
									$rezklima = array();
									if(!empty($_REQUEST['klima'])) {
										$rezklima = validirajKlimu($staza, $radioklima);
									} else {
										$rezklima = array("1", "2", "3", "4", "5");
									}
									
									$rezsmjestaj = array();
									if(!empty($_REQUEST['smjestaj_staze'])) {
										$rezsmjestaj = validirajSmjestaj($staza, $radiosmjestaj);
									} else {
										$rezsmjestaj = array("1", "2", "3", "4", "5");
									}
									
									$rezvrsta = array();
									if(!empty($_REQUEST['vrsta_staze'])) {
										$rezvrsta = validirajVrstu($staza, $checkvrsta);
									} else {
										$rezvrsta = array("1", "2", "3", "4", "5");
									}
									
									$reztezina = array();
									if(!empty($_REQUEST['tezina_staze'])) {
										$reztezina = validirajTezinu($staza, $checktezina);
									} else {
										$reztezina = array("1", "2", "3", "4", "5");
									}
									/*
									$reznadmorska = array();
									if(!empty($_REQUEST['nadmorska'])) {
										$reznadmorska = validirajNadmorsku($staza, $nadmorska);
									} else {
										$reznadmorska = array("1", "2", "3", "4", "5");
									}
                                    */
									
									$rezkilometraza = array();
									if(!empty($_REQUEST['kilometraza'])) {
										$rezkilometraza = validirajKilometrazu($staza, $kilometraza);
									} else {
										$rezkilometraza = array("1", "2", "3", "4", "5");
									}
									
									$rezaktivnost = array();
									if(!empty($_REQUEST['aktivnost'])) {
                                    $rezaktivnost = validirajAktivnost($okolica, $selectaktivnost);
									} else {
										$rezaktivnost = array("1", "2", "3", "4", "5");
									}
									
									
									$rez = array_intersect ($rezdrzava, $rezime, $rezklima, $rezvrsta, $reztezina, $rezkilometraza, $rezaktivnost);
								?>
								<td>
									<?php
										ispisiDrzavu($destinacija, $rez);
									?>
								</td>
								<td>
									<?php
										ispisiIme($staza, $rez);
									?>
								</td>
								<td>
									<?php
										ispisiKlimu($staza, $rez);
									?>
								</td>
								<td>
									<?php
										ispisiVrstu($staza, $rez);
									?>
								</td>
								<td>
									<?php
										ispisiTezinu($staza, $rez);
									?>
								</td>
                                <td>
									<?php
										ispisiKilometrazu($staza, $rez);
									?>
								</td>
								<td>
									<?php
										ispisiAktivnost($okolica, $rez);
									?>
								</td>								
							</tr>
						</table>
                        </br></br>
                        <?php
                            if (!empty($rez)) {
                                echo '<h2>Od kuda krenuti?</h2></br>';
                                $wikiids = vratiWikiId($staza, $rez);
                                echo '<table id=podaci>';
                                echo '<tr><th>Ime staze</th><th>Trailhead</th><th>Slika</th><th>Koordinate</th><th>Ukratko</th><th>Lokacija</th><th>Nominatim lokacija</th></tr>';
                                echo '<tr>';
                                foreach ($staza as $route) {
                                    if(in_array($route->getAttribute('idwiki'), $wikiids)) {
                                        echo '<td>';
                                        echo $route->getAttribute('ime_staze');
                                        echo '</td><td>';
                                        echo $route->getAttribute('trailhead');
                                        echo '</td><td>';

                                        $wiki = 'https://en.wikipedia.org/api/rest_v1/page/summary/' . $route->getAttribute('idwiki') ;
                                        $wikijson = file_get_contents ($wiki);
                                        $wikiarray = json_decode ($wikijson, true);

                                        $wikiaction = 'https://en.wikipedia.org/w/api.php?action=query&prop=revisions&rvprop=content&rvsection=0&titles=' . $route->getAttribute('idloc') . '&format=json';
                                        $wikiactionjson = file_get_contents ($wikiaction);

                                        $image = $wikiarray['originalimage']['source'];
                                        $imageData = base64_encode(file_get_contents($image));
                                        echo '<img width="200"  src="data:image/jpeg;base64,'.$imageData.'">';
                                        echo '</td><td>';
                                        echo $wikiarray['coordinates']['lat'] .', ' . $wikiarray['coordinates']['lon'];
                                        echo '</td><td>';
                                        $pos1 = strpos($wikiarray['extract'], '.');
                                        $pos2 = strpos($wikiarray['extract'], '.', $pos1 + 1);
                                        echo substr($wikiarray['extract'], 0, $pos2+1); 
                                        echo '</br></br>';
                                        echo '</td><td>';
                                        
                                        $pos1 = strpos($wikiactionjson, "location");
                                        $pos2 = strpos($wikiactionjson, '\n', $pos1 + strlen("location"));
                                        $lok = substr($wikiactionjson, $pos1, $pos2-$pos1);
                                        $lok = parsiraj($lok);
                                        echo $lok;
                                        echo '</td><td>';
                                        $nominatim = 'http://nominatim.openstreetmap.org/search?q=' . urlencode($lok) . '&format=xml';
                                       
                                        ini_set('user_agent', 'nina.zuccon@gmail.com');

                                        $xml = simplexml_load_file($nominatim);
                                        $json = json_encode($xml);
                                        $arr = json_decode($json, TRUE);

                                        echo $arr['place'][0]['@attributes']['lat'] . ', ' . $arr['place'][0]['@attributes']['lon'];                           
                                        echo '</td></tr>';
                                    }
                                }       
                                echo '</table>';
                            } else echo '<h2>Nema rezultata za traženi upit!</h2></br>';             
                        ?>
					</section>
				</div>

				<div id="footer">
					<p id="pp">Nina Zuccon</p>
					<img src="logo.jpg" alt="logo" height="70" width="70"/>
				</div>
			</body>
		</html>		


