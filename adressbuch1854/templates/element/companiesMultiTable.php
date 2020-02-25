<?php
/*
Creates a table containing the main information about multiple companies. It uses the given array or query object with the variable name $companies.
Adds a numbering if 'count' is set to true.
Uses a list of addresses (instead of simple breaks) if addrAsList is set to true;
*/

if(!isset($count)){
	$count=false;
}

if(!isset($addrAsList)){
	$addrAsList=false;
}
?>

<div class="table-responsive">
	<table>
		<tr>
			<?php if($count):?>
			<th><?= __('Nr') ?></th>
			<?php endif;?>
			<th><?= __('Name') ?></th>
			<th><?= __('Anmerkungen') ?></th>
			<th><?= __('Beruf') ?></th>
			<th><?= __('Adresse(n)') ?></th>
			<th><?= __('Sonstige Merkmale') ?></th>
			<th><?= __('Kategorien') ?></th>
		</tr>
		<?php
		$countNo = 1;
		foreach ($companies as $company): ?>
		<?php
			$cats = [];
			if($company->has('prof_category')){
				array_push($cats, $company->prof_category->name);
			}
			
			$plus = [];
			if($company->bold){
				array_push($plus, __('Vorab-Abonnent'));
			}
			if($company->notable_commercant){
				array_push($plus, 'Notable Commerçant');
			}
			if($company->advert){
				array_push($plus, __('mit Geschäftseintrag'));
			}
		?>
		<tr>
			<?php if($count):?>
			<td><?= $this->Number->format($countNo)?></td>
			<?php endif;?>
			<td><?= $this->Html->link(h($company->name), ['controller' => 'Companies', 'action' => 'view', $company->id]) ?></td>
			<td><?= h($company->specification_verbatim) ?></td>
			<td><?= h($company->profession_verbatim) ?></td>
			<td><?php
				if (!empty($company->addresses)){
					echo $this->element('addressList', ['addresses' => $company->addresses, 'list' => $addrAsList]);
				}
			?></td>
			<td><?= implode(', ', $plus)?></td>
			<td><?= implode(', ', $cats)?></td>
		</tr>
		<?php 
			$countNo++;
			endforeach;
		?>
	</table>
</div>