<?php

$dom = new DOMDocument();
$dom->load('podaci.xml');

$xp = new DOMXPath($dom);
$rezultat = $xp->query("/podaci/destinacija");

function validirajDrzavu ($destinacija, $drzava) {
	$rez = array();
	foreach($destinacija as $destinacija) {
			$drzavaxml = $destinacija->getAttribute('drzava');
			if (strpos(strtolower($drzavaxml), strtolower($drzava))!==false) array_push($rez, $destinacija->getElementsByTagName('staza')->item(0)->getAttribute('id'));			
	}
	return $rez;
}

function validirajImeStaze ($staza, $imestaze) {
	$rez = array();
	foreach($staza as $staza) {
			$imestazexml = $staza->getAttribute('ime_staze');
			if (strpos(strtolower($imestazexml), strtolower($imestaze))!==false) array_push($rez, $staza->getAttribute('id'));			
	}
	return $rez;
} 

function validirajKlimu ($staza, $radioklima) {
	$rez = array();
	foreach($staza as $staza) {
		$radioklimaxml = $staza->getAttribute('klima');
		if($radioklima==$radioklimaxml) array_push($rez, $staza->getAttribute('id'));
	}
	return $rez;
}

function validirajSmjestaj ($staza, $radiosmjestaj) {
	$rez = array();
	foreach($staza as $staza) {
		$radiosmjestajxml = $staza->getAttribute('smjestaj_staze');
		if($radiosmjestaj==$radiosmjestajxml) array_push($rez, $staza->getAttribute('id'));
	}
	return $rez;
}

function validirajVrstu ($staza, $checkvrsta) {
	$rez = array();
	$checkvrstaxml = array();
	foreach($staza as $staza) {
		foreach($staza->getElementsByTagName('vrsta_staze')->item(0)->childNodes as $child) {
			if(!($child->nodeName=="#text")) array_push($checkvrstaxml, $child->nodeName);
		}
		$c = array_intersect($checkvrsta, $checkvrstaxml);
		if (count($c) > 0) array_push($rez, $staza->getAttribute('id'));
		$checkvrstaxml=array();
	}
	return $rez;
}

function validirajTezinu ($staza, $checktezina) {
	$rez = array();
	$checktezinaxml = array();
	foreach($staza as $staza) {
		foreach($staza->getElementsByTagName('tezina_staze')->item(0)->childNodes as $child) {
			if(!($child->nodeName=="#text")) array_push($checktezinaxml, $child->nodeName);
		}
		$c = array_intersect($checktezina, $checktezinaxml);
		if (count($c) > 0) array_push($rez, $staza->getAttribute('id'));
		$checktezinaxml=array();
	}
	return $rez;
}

function validirajNadmorsku ($staza, $nadmorska) {
	if(!is_numeric($nadmorska)) return $rez = array("1", "2", "3", "4", "5");
	$rez = array();
	foreach($staza as $staza) {
		$nadmorskaxml = $staza->getAttribute('nadmorska_visina');
		if ($nadmorskaxml>=$nadmorska) array_push($rez, $staza->getAttribute('id'));			
	}
	return $rez;
}

function validirajKilometrazu ($staza, $kilometraza) {
	if(!is_numeric($kilometraza)) return $rez = array("1", "2", "3", "4", "5");
	$rez = array();
	foreach($staza as $staza) {
		$kilometrazaxml = $staza->getAttribute('kilometraza');
		if ($kilometrazaxml>=$kilometraza) array_push($rez, $staza->getAttribute('id'));			
	}
	return $rez;
}

function validirajAktivnost ($okolica, $selectaktivnost) {
	$rez = array();
	$selectaktivnostxml = array();
	foreach($okolica as $okol) {
		foreach($okol->getElementsByTagName('dodatna_sportska_aktivnost')->item(0)->childNodes as $child) {
            if($child->nodeName!="#text") array_push($selectaktivnostxml, $child->nodeName);            
        }
        $c = array_intersect($selectaktivnost, $selectaktivnostxml);        
        if (count($c) > 0) {
            $temp = $okol->parentNode->childNodes; 
            foreach($temp as $temp) {
                if ($temp->nodeName=="staza") $id = $temp->getAttribute('id');
            }
            array_push($rez, $id);
        }
        $selectaktivnostxml = array();  
    }
    return $rez;
}
   

function ispisiDrzavu ($destinacija, $rez) {
	foreach ($destinacija as $destinacija) {
		foreach ($rez as $value) {
			if ($destinacija->getElementsByTagName('staza')->item(0)->getAttribute('id')==$value) {
				echo $destinacija->getAttribute('drzava');
				echo "<br>";
			}
		}
	}
}

function ispisiIme ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				echo $staza->getAttribute('ime_staze');
				echo "<br>";
			}
		}
	}
}

function ispisiKlimu ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				echo $staza->getAttribute('klima');
				echo "<br>";
			}
		}
	}
}

function ispisiSmjestaj ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				echo $staza->getAttribute('smjestaj_staze');
				echo "<br>";
			}
		}
	}
}

function ispisiVrstu ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				foreach($staza->getElementsByTagName('vrsta_staze')->item(0)->childNodes as $child) {
					if(!($child->nodeName=="#text")) {
						echo $child->nodeName;
						echo " ";
					}
				}
				echo "<br>";
			}
		}
	}
}

function ispisiTezinu ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				foreach($staza->getElementsByTagName('tezina_staze')->item(0)->childNodes as $child) {
					if(!($child->nodeName=="#text")) {
						echo $child->nodeName;
						echo "<br>";
					}
				}
			}
		}
	}
}

function ispisiNadmorsku ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				echo $staza->getAttribute('nadmorska_visina');
				echo "<br>";
			}
		}
	}
}

function ispisiKilometrazu ($staza, $rez) {
	foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
				echo $staza->getAttribute('kilometraza');
				echo "<br>";
			}
		}
	}
}

function ispisiAktivnost ($okolica, $rez) {        
	foreach ($okolica as $okol) {
		foreach ($rez as $value) {
            $temp = $okol->parentNode->childNodes; 
            foreach($temp as $temp) {
                if ($temp->nodeName=="staza") $id = $temp->getAttribute('id');
            }
            if ($id==$value) {
                foreach($okol->getElementsByTagName('dodatna_sportska_aktivnost')->item(0)->childNodes as $child) {
                    if($child->nodeName!="#text") {
                        echo $child->nodeName;
                        echo " ";
                    }            
                }
            echo "<br>";
            }
            
        }
    }
}

function vratiWikiId ($staza, $rez) {
    $vrati = array();
    foreach ($staza as $staza) {
		foreach ($rez as $value) {
			if ($staza->getAttribute('id')==$value) {
                array_push($vrati, $staza->getAttribute('idwiki'));   
			}
		}
	}
    return $vrati;
}

function parsiraj($s)
{
    $r="";
    for($i=8; $i<strlen($s); $i++) 
         if (ctype_alpha ($s[$i]) || $s[$i]==',' || $s[$i]==' ' || is_numeric ($s[$i])) $r=$r.$s[$i];
    return $r;
}

?>