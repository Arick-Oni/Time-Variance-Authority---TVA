<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final";
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();
$loggedInEmployeeId = $_SESSION['ID'];

if (!isset($_SESSION['repair_requests'])) {
    $_SESSION['repair_requests'] = array();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weaponSerialNumber = $_POST['weapon_serial_number'];
    if (isset($_POST['repair_serial_no'])) {
        $weaponSerialNumber = $_POST['repair_serial_no'];
        $sql = "SELECT branch_no FROM repair_advancement WHERE active = 'active' ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $branchNo = $row['branch_no'];
        $sql = "UPDATE weapons SET employee_id=NULL,dept_id = $branchNo WHERE serial_no = $weaponSerialNumber";
        $conn->query($sql);
    } else if (isset($_POST['employee_id'])) {
        $employeeId = $_POST['employee_id'];
        $sql = "UPDATE weapons SET employee_id = $employeeId, armory_id=NULL WHERE serial_no = $weaponSerialNumber";
        $conn->query($sql);
    } else if (isset($_POST['serial_no'])) {
        $weaponSerialNumber = $_POST['serial_no'];
        $sql = "UPDATE weapons SET employee_id = NULL, dept_id = NULL WHERE serial_no = $weaponSerialNumber";
        $conn->query($sql);
    } else if (isset($_POST['request_repair_serial_no'])) {
        $weaponSerialNumber = $_POST['request_repair_serial_no'];
        
        $_SESSION['repair_requests'][] = $weaponSerialNumber;
    } else if (isset($_POST['decline_repair_serial_no'])) {
        $weaponSerialNumber = $_POST['decline_repair_serial_no'];
        $index = array_search($weaponSerialNumber, $_SESSION['repair_requests']);
        if ($index !== false) {
            unset($_SESSION['repair_requests'][$index]);
        }
    } else if (isset($_POST['serial_no'])) {
        $serial_no = $_POST['serial_no'];
        $sql = "UPDATE weapons SET dept_id = NULL WHERE serial_no = '$serial_no'";
        $conn->query($sql);
    }
    
    
} else {
    $sql = "SELECT serial_no, weapon_health, dept_id, employee_id, armory_id FROM weapons WHERE dept_id IS NULL AND employee_id IS NULL";
    $result = $conn->query($sql);
    $weapons = array();
    while($row = $result->fetch_assoc()) {
        $weapons[] = $row;
   
    }
}
$sql = "SELECT serial_no FROM weapons WHERE employee_id = $loggedInEmployeeId";
$result = $conn->query($sql);
$borrowedWeapons = array();
while($row = $result->fetch_assoc()) {
    $borrowedWeapons[] = $row;
}
$sql = "SELECT armory_id FROM armory";
$result = $conn->query($sql);
$armories = array();
while($row = $result->fetch_assoc()) {
    $armories[] = $row;
}
$sql = "SELECT serial_no FROM time_stick";
$result = $conn->query($sql);
$time_stick_serials = array();
while($row = $result->fetch_assoc()) {
    $time_stick_serials[] = $row['serial_no'];
}
$sql = "SELECT serial_no FROM temporal_reset_charge";
$result = $conn->query($sql);
$temporal_reset_charge_serials = array();
while($row = $result->fetch_assoc()) {
    $temporal_reset_charge_serials[] = $row['serial_no'];
}
if (isset($_GET['ser'])){
    $ser=$_GET['ser'];
    $sql = "INSERT INTO `requests` VALUES(NULL, current_timestamp(),'WeaponRepair','Scientist', 'Pending', '$loggedInEmployeeId', NULL, '$ser', NULL)";
        $conn->query($sql);
}

// $conn->close();
?>

<?php include 'minuteman.html'; ?>
<head>
    <title>MINUTEMAN</title>
    <link rel="stylesheet" type="text/css" href="table_style.css">
</head>
<body>
<div class="welcome-text">WELCOME, MINUTEMAN!</div>
    <div style="display: flex; justify-content: space-between;">
    <div class="dropdown-content-div">
            <h1 style="margin-left: 15px;font-size:30px  ">AVAILABLE  WEAPONS IN ARMORY:</h1>
            <div class="dropdown">
                <button class="dropbtn">>CLICK TO SELECT WEAPON TYPE<</button>
                <div class="dropdown-content">
                    <a href="#">Type: TIME STICK</a>
                    <a href="#">Type: TEMPORAL RESET CHARGE</a>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <a href="#" class="prev-arrow" style=" color: red; font-size: 35px; text-decoration: none;"><</a>
                <div style="display: flex; flex-direction: column; align-items: center; width: 500px; height: 100px;">
                <div class="weapon-name"></div>
                <div class="serial-number"></div>
                <div class="health"></div>
                <div class="armory-id"></div>
                </div>
                <a href="#" class="next-arrow" style=" color: red; font-size: 35px; text-decoration:none;">></a>
            </div>
            
            <div class="centered-content">
            <button onclick="selectForUse()" class="selectButton">Select for use</button>
            </div>
        </div>
        <div class="dropdown-content-div">
        <h1 style="margin-left: 15px;font: size 30px; ">BORROWED  WEAPONS:</h1>
        
        <div class="scrollable-table">
            <table id="borrowed-weapons-table">
                <tr>
                    <th>Weapon Name</th>
                    <th>Serial No.</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($borrowedWeapons as $weapon): ?>
                    <tr>
                        <td>
                        <?php 
                        if (in_array($weapon['serial_no'], $time_stick_serials)) {
                            echo 'TIME STICK';
                        } elseif (in_array($weapon['serial_no'], $temporal_reset_charge_serials)) {
                            echo 'TEMPORAL RESET CHARGE';
                        } else {
                            echo 'UNKNOWN WEAPON';
                        }
                        ?>
                        </td>
                        <td><?php echo $weapon['serial_no']; ?></td>
                        <td>
                        <button onclick="returnToArmory('<?php echo $weapon['serial_no']; ?>')" class="tableButton">Return to armory</button>
                       
                        <button  class="tableButton"><a href="minuteman.php?ser=<?php echo $weapon['serial_no'] ?>">Request for repair</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    </div>
    <div class="dropdown-content-div">
    <h1 style="margin-left: 15px;font: size 30px; ">WEAPONS PENDING FOR REPAIR:</h1>
    <div class="scrollable-table">
        <table id="pending-weapons-table">
            <tr>
                <th>Weapon Name</th>
                <th>Serial No.</th>
            </tr>
            <?php
            $sql20="SELECT * FROM `requests` WHERE `Requestee_ID`='$loggedInEmployeeId' AND `Status`='Pending' AND `Weapon_ID` IS NOT NULL" ;
            $result20 = $conn->query($sql20);
            $row20=mysqli_fetch_all($result20, MYSQLI_ASSOC);
            foreach ($row20 as $roww): ?>
                <tr>
                <td>
                    <?php 
                    if (in_array($roww['Weapon_ID'], $time_stick_serials)) {
                        echo 'TIME STICK';
                    } elseif (in_array($roww['Weapon_ID'], $temporal_reset_charge_serials)) {
                        echo 'TEMPORAL RESET CHARGE';
                    } else {
                        echo 'UNKNOWN WEAPON';
                    }
                    ?>
                    </td>
                    <td><?php echo $roww['Weapon_ID']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
    </div>
</body>
<script>
var allWeapons = <?php echo json_encode($weapons); ?>;
var weapons = [];
var timeStickSerials = <?php echo json_encode($time_stick_serials); ?>;
var temporalResetChargeSerials = <?php echo json_encode($temporal_reset_charge_serials); ?>;
var index = 0;
var dropdownItems = document.querySelectorAll('.dropdown-content a');
var dropdownButton = document.querySelector('.dropbtn');
var armories = <?php echo json_encode($armories); ?>;
dropdownItems.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.preventDefault();
        var selectedWeaponType = event.target.innerText;
        dropdownButton.innerText = selectedWeaponType;

        if (selectedWeaponType === 'Type: TIME STICK') {
            weapons = allWeapons.filter(function(weapon) {
                return timeStickSerials.includes(weapon.serial_no.toString());
            });
        } else if (selectedWeaponType === 'Type: TEMPORAL RESET CHARGE') {
            weapons = allWeapons.filter(function(weapon) {
                return temporalResetChargeSerials.includes(weapon.serial_no.toString());
            });
        }
        index = 0;
        updateWeapon(); 
    });
});
function requestForRepair(serialNo) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'minuteman.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('serial_no=' + encodeURIComponent(serialNo));
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Repair requested successfully!');
            location.reload(); 
        } else {
            alert('An error occurred: ' + xhr.status);
        }
    };
}
function updateWeapon() {
    if (weapons.length === 0) {
        document.querySelector('.weapon-name').innerText = '[No weapons to display]';
        document.querySelector('.serial-number').innerText = '';
        document.querySelector('.health').innerText = '';
        document.querySelector('.armory-id').innerText = '';
    } else {
        var weapon = weapons[index];
        var serialNumber = weapon.serial_no.toString();
        var weaponName;
        if (timeStickSerials.includes(serialNumber)) {
            weaponName = 'TIME STICK';
        } else if (temporalResetChargeSerials.includes(serialNumber)) {
            weaponName = 'TEMPORAL RESET CHARGE';
        } else {
            weaponName = 'UNKNOWN WEAPON';
        }
        document.querySelector('.weapon-name').innerText = weaponName;
        document.querySelector('.serial-number').innerText = 'Serial no.: ' + weapon.serial_no;
        document.querySelector('.health').innerText = 'Health: ' + weapon.weapon_health;
        document.querySelector('.armory-id').innerText = 'Located in: Armory ' + weapon.armory_id;
    }
}

function selectForUse() {
    var weapon = weapons[index];
    var weaponSerialNumber = weapon.serial_no;
    var employeeId = '<?php echo $loggedInEmployeeId; ?>'; 
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'minuteman.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('weapon_serial_number=' + weaponSerialNumber + '&employee_id=' + employeeId);
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Weapon selected for use successfully!');
            location.reload();
        } else {
            alert('An error occurred: ' + xhr.status);
        }
    };
}

function returnToArmory(serialNo) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'minuteman.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('serial_no=' + encodeURIComponent(serialNo));
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Weapon returned to armory successfully!');
            location.reload(); 
        } else {
            alert('An error occurred: ' + xhr.status);
        }
    };
}

document.querySelector('.next-arrow').addEventListener('click', function() {
    if (index < weapons.length - 1) {
        index++;
        updateWeapon();
    }
});
document.querySelector('.prev-arrow').addEventListener('click', function() {
    if (index > 0) {
        index--;
        updateWeapon();
    }
});

window.onload = function() {
    updateWeapon();
};
</script>

