import QRCode from 'qrcode'
import { useCounterStore } from 'stores/example-store'
import { Printd } from 'printd'
import conversor from 'conversor-numero-a-letras-es-ar'
import { jsPDF } from 'jspdf'
import moment from 'moment'
export class Imprimir {
  static facturaPdf (sale) {
    console.log(sale)
    let distenceLength = 65
    if (sale.delyvery === 'Si') {
      distenceLength = 75
    }
    /* eslint-disable */
    const doc = new jsPDF({
      // orientation: 'l',
      unit: 'mm',
      format: [distenceLength+4*sale.details.length, 55]
    })
    let y = 5
    doc.setFont('courier', 'bold')
    doc.setFontSize(10)
    doc.text(useCounterStore().agencia.nombre, 28, y, { align: 'center' })
    doc.setFont(undefined, 'normal')
    // doc.text(useCounterStore().agencia.nit, 28, y+4, { align: 'center' })
    doc.text(useCounterStore().agencia.direccion, 28, y+8, { align: 'center', maxWidth: 50 })
    doc.text('Tel '+useCounterStore().agencia.telefono, 28, y+16, { align: 'center' })
    doc.setFont(undefined, 'bold')
    doc.text(sale.paraLlevar=='Si' ? 'Para llevar' : 'En mesa', 28, y+20, { align: 'center' })
    doc.line(5, y+22, 50, y+22)

    doc.setFontSize(9)
    doc.text('CLIENTE', 5, y+25)
    doc.setFont(undefined, 'normal')
    doc.text(sale.client==null?'':sale.clientName, 28, y+28, { align: 'center', maxWidth: 50 })
    doc.setFont(undefined, 'bold')
    doc.text('FECHA', 5, y+32)
    doc.setFont(undefined, 'normal')
    doc.text(sale.date, 28, y+32, { align: 'center', maxWidth: 50 })
    doc.setFont(undefined, 'bold')
    doc.text('TIPO', 5, y+36)
    doc.setFont(undefined, 'normal')
    doc.text(sale.type, 28, y+36, { align: 'center', maxWidth: 50 })
    doc.line(5, y+38, 50, y+38)

    doc.setFont(undefined, 'bold')
    doc.text('CANT    PRODUCT   SUB', 5, y+41)
    let y2 = y+45
    doc.setFont(undefined, 'normal')
    sale.details.forEach(r => {
      doc.setFontSize(7)
      doc.text(`${r.quantity} ${r.productName}`, 5, y2, { maxWidth: 40 })
      doc.setFontSize(9)
      doc.text(`${r.total}`, 50, y2, { align: 'right'})
      y2 += 4
    })
    y = y2
    doc.line(5, y, 50, y)
    doc.setFont(undefined, 'bold')
    doc.text('TOTAL', 5, y+4)
    doc.setFont(undefined, 'normal')
    doc.text(`${sale.total}`, 50, y+4, { align: 'right' })
    doc.setFont(undefined, 'bold')
    doc.text('USUARIO', 5, y+8)
    doc.setFont(undefined, 'normal')
    const nameSplit = useCounterStore().user.name.split(' ')
    doc.text(nameSplit[0], 50, y+8, { align: 'right', maxWidth: 50 })
    doc.text(sale.deliveryAddress==null?'':sale.deliveryAddress, 28, y+12, { align: 'center', maxWidth: 50 })
    doc.save(`sale-${sale.id}${moment().format('YYYYMMDDHHmmss')}.pdf`)
    // doc.autoPrint();
    // doc.output('dataurlnewwindow', {filename: 'comprobante.pdf'});
  }
  static menuPrint (menu) {
    // console.log(menu)

    const cm = this
    /* eslint-disable */
    const doc = new jsPDF('p', 'mm', 'letter')

    doc.addFont("fonts/DancingScript-VariableFont_wght.ttf", "Dancing", "normal");
    doc.addFont("fonts/DancingScript-Bold.ttf", "Dancing", "bold");
    doc.addFont("fonts/Belanosima-Regular.ttf", "Belanosima", "normal");
    doc.addFont("fonts/Belanosima-Bold.ttf", "Belanosima", "bold");
    doc.addFont("fonts/Poppins-Regular.ttf", "Poppins", "normal");
    doc.addFont("fonts/Poppins-Bold.ttf", "Poppins", "bold");
    cm.cabezera(doc, '')
    let iAux = 0
    for (let i = 0; i < menu.length; i++) {
      if ((i%2)===0) {
        doc.setFont('Dancing', 'bold')
        doc.setFontSize(17)
        doc.setTextColor(57,30,19);
        doc.text(menu[i].name, 70, 91+(iAux*25), { align: 'center', maxWidth: 50 })

        doc.setFont('Belanosima', 'normal')
        doc.setFontSize(12)
        doc.setTextColor(249, 28, 4);
        doc.text(menu[i].price+' Bs.', 55, 78+(iAux*25), { align: 'left', maxWidth: 50 })

        doc.setFont('Poppins', 'normal')
        doc.setFontSize(8)
        doc.setTextColor(0,0,0);
        doc.text(menu[i].description==null?'':menu[i].description, 60, 105+(iAux*25), { align: 'center', maxWidth: 55 })

        var imgData = menu[i].base64;
        doc.addImage(imgData, 'jpg', 20, 80+(iAux*25), 20, 20);

      }else{
        doc.setFont('Dancing', 'bold')
        doc.setFontSize(17)
        doc.setTextColor(57,30,19);
        doc.text(menu[i].name, 170, 91+((iAux-1)*25), { align: 'center', maxWidth: 50 })

        doc.setFont('Belanosima', 'normal')
        doc.setFontSize(12)
        doc.setTextColor(249, 28, 4);
        doc.text(menu[i].price+' Bs.', 155, 80+((iAux-1)*25), { align: 'left', maxWidth: 50 })

        doc.setFont('Poppins', 'normal')
        doc.setFontSize(8)
        doc.setTextColor(0,0,0);
        doc.text(menu[i].description?'':menu[i].description, 160, 107+((iAux-1)*25), { align: 'center', maxWidth: 55 })
        var imgData = menu[i].base64;
        doc.addImage(imgData, 'jpg', 120, 80+((iAux-1)*25), 20, 20);
      }
      iAux++
      if (iAux===8) {
        if (i>0 && i<menu.length-1) {
          doc.addPage()
        }
        if (i<menu.length-1) {
          cm.cabezera(doc, '')
          iAux = 0
        }
      }
    }

    doc.save(`menu-${moment().format('YYYYMMDDHHmmss')}.pdf`)
    // let y = 5
    // doc.setFont('courier', 'bold')
    // doc.setFontSize(10)
    // doc.text(useCounterStore().agencia.nombre, 28, y, { align: 'center' })
    // doc.setFont(undefined, 'normal')
    // // doc.text(useCounterStore().agencia.nit, 28, y+4, { align: 'center' })
    // doc.text(useCounterStore().agencia.direccion, 28, y+8, { align: 'center', maxWidth: 50 })
    // doc.text('Tel '+useCounterStore().agencia.telefono, 28, y+16, { align: 'center' })
    // doc.setFont(undefined, 'bold')
    // doc.text(sale.paraLlevar=='Si' ? 'Para llevar' : 'En mesa', 28, y+20, { align: 'center' })
    // doc.line(5, y+22, 50, y+22)
    //
    // doc.setFontSize(9)
    // doc.text('CLIENTE', 5, y+25)
    // doc.setFont(undefined, 'normal')
    // doc.text(sale.client==null?'':sale.clientName, 28, y+28, { align: 'center', maxWidth: 50 })
    // doc.setFont(undefined, 'bold')
    // doc.text('FECHA', 5, y+32)
    // doc.setFont(undefined, 'normal')
    // doc.text(sale.date, 28, y+32, { align: 'center', maxWidth: 50 })
    // doc.setFont(undefined, 'bold')
    // doc.text('TIPO', 5, y+36)
    // doc.setFont(undefined, 'normal')
    // doc.text(sale.type, 28, y+36, { align: 'center', maxWidth: 50 })
    // doc.line(5, y+38, 50, y+38)
    //
    // doc.setFont(undefined, 'bold')
    // doc.text('CANT    PRODUCT   SUB', 5, y+41)
    // let y2 = y+45
    // doc.setFont(undefined, 'normal')
    // sale.details.forEach(r => {
    //   doc.setFontSize(7)
    //   doc.text(`${r.quantity} ${r.productName}`, 5, y2, { maxWidth: 40 })
    //   doc.setFontSize(9)
    //   doc.text(`${r.total}`, 50, y2, { align: 'right'})
    //   y2 += 4
    // })
    // y = y2
    // doc.line(5, y, 50, y)
    // doc.setFont(undefined, 'bold')
    // doc.text('TOTAL', 5, y+4)
    // doc.setFont(undefined, 'normal')
    // doc.text(`${sale.total}`, 50, y+4, { align: 'right' })
    // doc.setFont(undefined, 'bold')
    // doc.text('USUARIO', 5, y+8)
    // doc.setFont(undefined, 'normal')
    // const nameSplit = useCounterStore().user.name.split(' ')
    // doc.text(nameSplit[0], 50, y+8, { align: 'right', maxWidth: 50 })
    // doc.text(sale.deliveryAddress==null?'':sale.deliveryAddress, 28, y+12, { align: 'center', maxWidth: 50 })


    // doc.autoPrint();
    // doc.output('dataurlnewwindow', {filename: 'comprobante.pdf'});
  }
  static cabezera (doc, i){

    const img = new Image()
    img.src = 'menu.png'
    doc.addImage(img, 'PNG', 0, 0, 216, 280)

    doc.setFont('Belanosima', 'bold')
    doc.setTextColor(57,30,19);
    doc.setFontSize(30)
    doc.text(useCounterStore().agencia.nombre, 108, 28, { align: 'center', maxWidth: 100 })
    doc.setFontSize(70)
    doc.text(i+' MENU', 108, 58, { align: 'center', maxWidth: 100 })
  }

  static factura (factura) {
    return new Promise((resolve, reject) => {
      const ClaseConversor = conversor.conversorNumerosALetras
      const miConversor = new ClaseConversor()
      const a = miConversor.convertToText(parseInt(factura.montoTotal))
      const opts = {
        errorCorrectionLevel: 'M',
        type: 'png',
        quality: 0.95,
        width: 100,
        margin: 1,
        color: {
          dark: '#000000',
          light: '#FFF'
        }
      }
      const env = useCounterStore().agencia
      QRCode.toDataURL(env.url2 + 'consulta/QR?nit=' + env.nit + '&cuf=' + factura.cuf + '&numero=' + factura.numeroFactura + '&t=2', opts).then(url => {
        let cadena = `${this.head()}
  <div style='padding-left: 0.5cm;padding-right: 0.5cm'>
      <div class='titulo'>FACTURA <br>CON DERECHO A CREDITO FISCAL</div>
      <div class='titulo2'>${env.razon} <br>
      Casa Matriz<br>
      No. Punto de Venta ${factura.codigoPuntoVenta}<br>
${env.direccion.substring(0, 38)}<br>
${env.direccion.substring(38)}<br>
Tel. ${env.telefono}<br>
Oruro</div>
<hr>
<div class='titulo'>NIT</div>
<div class='titulo2'>${env.nit}</div>
<div class='titulo'>FACTURA N°</div>
<div class='titulo2'>${factura.numeroFactura}</div>
<div class='titulo'>CÓD. AUTORIZACIÓN</div>
<div class='titulo2'>${factura.cuf}</div>
<hr>
<table>
<tr><td class='titder'>NOMBRE/RAZÓN SOCIAL:</td><td class='contenido'>${factura.client.nombreRazonSocial}</td>
</tr><tr><td class='titder'>NIT/CI/CEX:</td><td class='contenido'>${factura.client.numeroDocumento}</td></tr>
<tr><td class='titder'>COD. CLIENTE:</td ><td class='contenido'>${factura.client.id}</td></tr>
<tr><td class='titder'>FECHA DE EMISIÓN:</td><td class='contenido'>${factura.fechaEmision}</td></tr>
</table><hr><div class='titulo'>DETALLE</div>`
        factura.details.forEach(r => {
          cadena += `<div style='font-size: 12px'><b>${r.product_id} ${r.descripcion} </b></div>`
          cadena += `<div>${r.cantidad} ${parseFloat(r.precioUnitario).toFixed(2)} 0.00
                    <span style='float:right'>${parseFloat(r.subTotal).toFixed(2)}</span></div>`
        })
        cadena += `<hr>
      <table style='font-size: 8px;'>
      <tr><td class='titder' style='width: 60%'>SUBTOTAL Bs</td><td class='conte2'>${parseFloat(factura.montoTotal).toFixed(2)}</td></tr>
      <tr><td class='titder'>DESCUENTO Bs</td><td class='conte2'>0.00</td></tr>
      <tr><td class='titder'>TOTAL Bs</td><td class='conte2'>${parseFloat(factura.montoTotal).toFixed(2)}</td></tr>
      <tr><td class='titder'>MONTO GIFT CARD Bs</td ><td class='conte2'>0.00</td></tr>
      <tr><td class='titder'>MONTO A PAGAR Bs</td><td class='conte2'>${parseFloat(factura.montoTotal).toFixed(2)}</td></tr>
      <tr><td class='titder' style='font-size: 8px'>IMPORTE BASE CRÉDITO FISCAL Bs</td>
      <td class='conte2'>${parseFloat(factura.montoTotal).toFixed(2)}</td></tr>
      </table>
      <br>
      <div>Son ${a} ${((parseFloat(factura.montoTotal) - Math.floor(parseFloat(factura.montoTotal))) * 100).toFixed(2)} /100 Bolivianos</div><hr>
      <div class='titulo2' style='font-size: 9px'>
      ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS,<br>
      EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE<br>
      ACUERDO A LEY<br><br>
      ${factura.leyenda} <br><br>
      “Este documento es la Representación Gráfica de un<br>
      Documento Fiscal Digital emitido en una modalidad de<br>
      facturación en línea”</div><br>
      <div style='display: flex;justify-content: center;'> <img  src="${url}" ></div></div>
      </div>
</body>
</html>`
        document.getElementById('myElement').innerHTML = cadena
        const d = new Printd()
        d.print(document.getElementById('myElement'))
        resolve(url)
      }).catch(err => {
        reject(err)
      })
    })
  }

  static head () {
    return `<html>
<style>
      .titulo{
      font-size: 12px;
      text-align: center;
      font-weight: bold;
      }
      .titulo2{
      font-size: 10px;
      text-align: center;
      }
            .titulo3{
      font-size: 10px;
      text-align: center;
      width:70%;
      }
            .contenido{
      font-size: 10px;
      text-align: left;
      }
      .conte2{
      font-size: 10px;
      text-align: right;
      }
      .titder{
      font-size: 12px;
      text-align: right;
      font-weight: bold;
      }
      hr{
  border-top: 1px dashed   ;
}
  table{
    width:100%
  }
  h1 {
    color: black;
    font-family: sans-serif;
  }
  </style>
<body>
<div style="width: 300px;">`
  }
}
