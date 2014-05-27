<?php

return [
	'pagination' => function(){
		if(Agent::isMobile())
			return 10;

		return 20;
	}
];