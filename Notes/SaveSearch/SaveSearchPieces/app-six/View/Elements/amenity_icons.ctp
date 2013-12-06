<?php

	if ($prop['wheelchair_accessible']) {
		echo $this->Html->image('handicap-icon.png');
	}

	if ($prop['pets_allowed']) {
		echo $this->Html->image('footprint-icon.png');
	}

	if ($prop['credit_accepted']) {
		echo $this->Html->image('card-icon.png');
	}

	if ( ! $prop['smoking_allowed']) {
		echo $this->Html->image('smoke-icon.png');
	}

