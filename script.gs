function doPost(e) {
  var sheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
  
  var data = JSON.parse(e.postData.contents);
  
  var rowData = [
    data.a, data.b, data.c, data.d, data.e, 
    data.f, data.g, data.h, data.i, data.j
  ];
  
  sheet.appendRow(rowData);
  
  return ContentService.createTextOutput('Row added successfully');
}