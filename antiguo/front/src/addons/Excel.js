import xlsx from 'json-as-xlsx'
import moment from 'moment'

export class Excel {
  static export (data) {
    // console.log(data)
    const settings = {
      fileName: 'Report' + moment().format('YYYY-MM-DD HH:mm:ss'), // Name of the spreadsheet
      // extraLength: 3, // A bigger number means that columns will be wider
      // writeMode: "writeFile", // The available parameters are 'WriteFile' and 'write'. This setting is optional. Useful in such cases https://docs.sheetjs.com/docs/solutions/output#example-remote-file
      writeOptions: {} // Style options from https://docs.sheetjs.com/docs/api/write-options
      // RTL: true, // Display the columns from right-to-left (the default value is false)
    }

    xlsx(data, settings) // Will download the excel file
  }
}
