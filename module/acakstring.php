<?php
function acak($panjang)
	{
		$pengacak = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789NAJB";
		$string = '';
		for($i = 0; $i < $panjang; $i++)
			{
				$pos = rand(0, strlen($pengacak)-1);
				$string .= $pengacak{$pos};
			}
		return $string;
	}
?>