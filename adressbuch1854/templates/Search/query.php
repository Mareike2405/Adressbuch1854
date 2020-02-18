<?php
	// defining the options-arrays for the search form
	
	$optionsArrMod = [];
	$optionsArrOld = [];
	$optionsRank = [];
	$optionsSoc = [];
	$optionsMil = [];
	$optionsOcc = [];
	$optionsCat = [];
	
	foreach($arrondissements as $arr){
		$id = $arr->id;
		$no = $arr->no;
		$type = $arr->type;
		if($type == 'pre1860'){
			$type = __('alt');
			if($no == 1){
				array_push($optionsArrOld, [$id => $no.'ier ('.$type.')']);
			} else {
				array_push($optionsArrOld, [$id => $no.'ième ('.$type.')']);
			}
		} else {
			$type = __('modern');
			if($no == 1){
				array_push($optionsArrMod, [$id => $no.'ier ('.$type.')']);
			} else {
				array_push($optionsArrMod, [$id => $no.'ième ('.$type.')']);
			}
		}
	}
	
	foreach($ranks as $rank){
		$id = $rank->id;
		$name = $rank->rank;
		array_push($optionsRank, [$id => __($name)]);
	}
	
	foreach($socialStatuses as $socialStat){
		$id = $socialStat->id;
		$status = $socialStat->status;
		array_push($optionsSoc, [$id => __($status)]);
	}
	
	foreach($militaryStatuses as $militaryStat){
		$id = $militaryStat->id;
		$status = $militaryStat->status;
		array_push($optionsMil, [$id => __($status)]);
	}
	
	foreach($occupationStatuses as $occupationStat){
		$id = $occupationStat->id;
		$status = $occupationStat->status;
		array_push($optionsOcc, [$id => __($status)]);
	}
	
	foreach($categories as $cat){
		$id = $cat->id;
		$name = $cat->name;
		array_push($optionsCat, [$id => __($name)]);
	}
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="search form content">
            <?= $this->Form->create($persons, ['type' => 'get', 'url' => '/search/results']) ?>
            <!-- Für spätere Befüllung des Forms
			mit den bereits eingegebenen Suchparametern bei Sprung von search.php zu query.php:
			$this->Form->setValueSources('query'])-->
            <fieldset>
                <legend><?= __('Search for a person') ?></legend>
                <div class="form content names">
				<h5 class="heading"><?= __('Personen- oder Firmenname')?></h5>
				<?php
                    echo $this->Form->control('name', ['label' => __('Name')]);
                    echo $this->Form->control('first_name', ['label' => __('Vorname')]);
					echo $this->Form->label('gender', __('Geschlecht'));
					echo $this->Form->radio('gender', [['value' => 'm', 'text' => __('Männlich')], ['value' => 'f', 'text' => __('weiblich')]]);
                ?>
				</div>
				<div class="form content profession">
				<h5 class="heading"><?= __('Beruf')?></h5>
				<?php
					echo $this->Form->control('prof', ['label' => __('Beruf')]);
					
					echo $this->Form->label('prof_cat', __('Kategorie'));
					echo $this->Form->select('prof_cat', $optionsCat, ['empty' => true]);
				?>
				</div>
				<div class="form content address">
				<h5 class="heading"><?= __('Adresse')?></h5>
				<?php
                    echo $this->Form->control('street', ['label' => __('Straße')]);                    
					echo $this->Form->label('arr_new', __('Arrondissement').' ('.__('modern').')');
					echo $this->Form->select('arr_new', $optionsArrMod, ['empty' => true]);
					echo $this->Form->label('arr_old', __('Arrondissement').' ('.__('alt').')');
					echo $this->Form->select('arr_old', $optionsArrOld, ['empty' => true]);
                ?>
				</div>
				<div class="form content persAttributes">
				<h5 class="heading"><?= __('Weitere Merkmale')?></h5>
				<?php
					
					echo $this->Form->label('ldh_rank', __('Rang der Légion d\'Honneur'));
					echo $this->Form->select('ldh_rank', $optionsRank, ['empty' => true]);
					
					echo $this->Form->label('institut', __('Mitglied des Institut de France?').' (de l\'Institut)');
					echo $this->Form->radio('institut', [['value' => True, 'text' => __('Ja')], ['value' => False, 'text' => __('Nein')]]);
                    
					echo $this->Form->label('soc_stat', __('Sozialer Stand'));
					echo $this->Form->select('soc_stat', $optionsSoc, ['empty' => true]);
                    
					echo $this->Form->label('mil_stat', __('Militärstatus'));
					echo $this->Form->select('mil_stat', $optionsMil, ['empty' => true]);
                    
					echo $this->Form->label('occ_stat', __('Beruflicher Status'));
					echo $this->Form->select('occ_stat', $optionsOcc, ['empty' => true]);
					
					echo $this->Form->label('bold', __('Hat das Adressbuch vorabonniert?').' '.__('(im Buch fett gedruckt)'));
					echo $this->Form->radio('bold', [['value' => True, 'text' => __('Ja')], ['value' => False, 'text' => __('Nein')]]);
					
					echo $this->Form->label('advert', __('Hat einen Eintrag in der Geschäftsliste?'));
					echo $this->Form->radio('advert', [['value' => True, 'text' => __('Ja')], ['value' => False, 'text' => __('Nein')]]);
				?>
				</div>
            </fieldset>
			<?= $this->Form->button(__('Search')) ?>
            <?= $this->Form->end() ?>
			Tipp: Falls Ihre Suche nicht die gewünschten Ergebnisse liefert, versuchen Sie erneut mit weniger Eingaben zu suchen. Probieren Sie auch verschiedene
			Schreibweisen von Straßen- und Personennamen aus und suchen Sie zunächst ohne Vornamen, da diese im Buch häufig nicht vorhanden oder stark abgekürzt sind.
			<!-- Hier eine Info hin wie "Probieren Sie verschiedene Schreibweisen der Namen aus. Wenn Sie nach einer Person suchen,
			und bei Eingabe des Namens und Vornamens keine Ergebnisse erhalten, suchen Sie zunächst ohne Vornamen. Meist sind die Vornamen im
			Adressbuch nicht vorhanden / nur mit einem Buchstaben abgkürzt.-->
        </div>
    </div>
</div>
