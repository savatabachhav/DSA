<?php 

/**
 * Problem Statement
 * 1. Assume their is a socity of Multiple Buildings
 * 2. All the building are in a row and with same number of floors.
 * 3. The distance between every consecutive building is same. (Consider it as a 1 Unit)
 * 4. The socity can be access by only crossing security gate marked as G
 * 5. The distance between Security gate and First building is also considered as 1 unit.
 * 6. The distance between every consecutive floor is also to be considered as 1 unit.
 * 7. Consider a delivery boy who arrives at the Security Gate to perform delivery of items at verious flats in the socity.
 * 8. We have to calculate the distance that the Delivery Boy needs to Travel To Deliver all the parcels. The calculation of the distance has to start form the Secutiry Gate G and he returns
 * Write a program which will seek following input from the user.
 *
 * 1. Number of Building in the Socity
 * 2. Number of Floor in the Building
 * 3. Total Number of Parcels to be Delivered
 * 4. For each parcel, the delivery location (each location to be considered as a-b where a is builing number and b is floor number)
 * The program should output the total distance to be Travelled by the delivery boy.
 *
 */
class DeliverySolutions {
	var $numberOfBuilding = 0;
	var $numberOfFloor = 0;
	var $parcels = 0;
	var $parcelLocations = 0;


	/*runtime vars*/
	var $buildingWiseFloor = [];

	var $finalDeliveryDistance = 0;
	function __construct($numberOfBuilding, $numberOfFloor, $parcels, $parcelLocations) {
		$this->numberOfBuilding = $numberOfBuilding;
		$this->numberOfFloor 	= $numberOfFloor;
		$this->parcels 			= $parcels;
		$this->parcelLocations 	= $parcelLocations;

		$this->calculateTotalDistance();
	}
	function calculateTotalDistance() {
		$this->sortBuldingwiseFloor();
		$buldingTravel 		= $this->calculateBuildingTravelDistance();
		$securityGateTravel = $this->calculateSecurityGateTravelDistance();
		$this->finalDeliveryDistance = $buldingTravel+$securityGateTravel;
	}
	/*
	Calculation total distance requiered to travel in the building for To and Frow
	*/
	function calculateBuildingTravelDistance() {
		$totalBuldingTravelDistance = 0;
		foreach ($this->buildingWiseFloor as $building) {
			$maxFloor = max($building);
			$totalBuldingTravelDistance += ($maxFloor*2);
		}
		return $totalBuldingTravelDistance;
	}
	/*
	Calculation total distance requiered to travel by the Security Gate
	*/
	function calculateSecurityGateTravelDistance() {
		return count($this->buildingWiseFloor)*2;
	}
	/*
	Separated building_no as index and florcount is tha value.
	*/
	function sortBuldingwiseFloor() {
		$this->buildingWiseFloor = [];
		foreach ($this->parcelLocations as $indivisualParcel) {
			$this->buildingWiseFloor[$indivisualParcel[0]][] = $indivisualParcel[1];
		}
	}
}

/*
Driver Code
*/
$numberOfBuilding 	= 6;
$numberOfFloor 		= 4;
$parcels 			= 6;
$parcelLocations 	= [[1,2],[2,4],[3,2],[4,4],[5,2],[6,4]];

$objDeliverySolution = new DeliverySolutions($numberOfBuilding, $numberOfFloor, $parcels, $parcelLocations);
?>
<table border="1">
	<tr>
		<th colspan="1" rowspan="4">Input Parameters</th>
		<th>Number Of Buildings</th>
		<td align="right"><?php echo $numberOfBuilding; ?></td>
	</tr>
	<tr>
		<th>Number of Floor</th>
		<td align="right"><?php echo $numberOfFloor; ?></td>
	</tr>
	<tr>
		<th>Number Of Parcels</th>
		<td align="right"><?php echo $parcels; ?></td>
	</tr>
	<tr>
		<th>Parcel Locations</th>
		<td align="right"><?php echo json_encode($parcelLocations); ?></td>
	</tr>
	<tr>
		<th colspan="1" rowspan="4">Output</th>
		<th>Distance Travelled by Delivery Boy</th>
		<td align="right"><?php echo $objDeliverySolution->finalDeliveryDistance; ?> <b>Units</b></td>
	</tr>
</table>
