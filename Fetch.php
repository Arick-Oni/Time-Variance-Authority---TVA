<!DOCTYPE html>
<html>
<head>
    <title>Device List</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body><div>HI</div>
    <div id="device-list">
        <!-- Device list content will be displayed here -->
    </div>

    <script>
        // Function to fetch device list data from server
        function fetchDeviceList() {
            $.ajax({
                url: 'fetch_device_list.php', // Replace with your PHP script to fetch data
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Update the device list on the webpage
                    var deviceListHTML = '';
                    data.forEach(function(device) {
                        deviceListHTML += '<div>' + device.name + '</div>'; // Modify this line based on your data structure
                    });
                    $('#device-list').html(deviceListHTML);
                }
            });
        }

        // Call fetchDeviceList initially when the page loads
        fetchDeviceList();

        // You can also call fetchDeviceList after certain actions (like adding/removing items)
        // For example, after adding a new device, call fetchDeviceList() to update the list
    </script>
</body>
</html>
