<?php
for ($i = 0; $i < 7; $i++)
{
	$day = time() + ($i * 60 * 60 * 24) + ($week * 60 * 60 * 24 * 7);
	?>
	<ul>
		<li class="dates1"><div><?php echo date('j', $day).' '.$lang[date('M', $day)]; ?></div><div><?php echo $lang[date('l', $day)]; ?></div></li>
		<?php
		foreach ($hours['hours'] as $key => $hour)
		{
			$disabled = false;
			if (!$week && !$i && strtotime($hour) < time())
			{
				$disabled = true;
			}
			else
			{
				$time = strtotime(date('Y-m-d', $day).' '.$hour);
				foreach ($hours['reservations'] as $reservation)
				{
					$res = strtotime($reservation);
					
					if (($res <= $time) && ($res + 3600 >= $time))
					{
						$disabled = true;
						break;
					}
				}
			}
			echo '<li class="hour"><input type="radio" name="start" value="'.date('Y-m-d', $day).' '.$hour.'" id="hour'.$i.$key.'" '.($disabled ? 'disabled="disabled"' : '' ).' />';
			echo '<label for="hour'.$i.$key.'" class="noselect"><span>'.substr($hour, 0, 5).'</span></label></li>';
		}
		?>
	</ul>
	<?php
}
?>
