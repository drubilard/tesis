$('#example2').Tabledit({
    url: 'example.php',
    eventType: 'dblclick',
    editButton: false,
    columns: {
        identifier: [0, 'id'],
        editable: [[1, 'car'], [2, 'color', '{"1": "Red", "2": "Green", "3": "Blue"}']]
    }
});