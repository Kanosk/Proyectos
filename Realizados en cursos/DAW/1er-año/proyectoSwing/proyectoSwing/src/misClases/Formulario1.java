package misClases;


import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import javax.xml.transform.Result;
import javax.xml.transform.Source;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerConfigurationException;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;
import org.json.simple.*;
import org.w3c.dom.DOMImplementation;
import org.w3c.dom.Document;
import org.w3c.dom.Element;

/**
 *
 * @author Cándido
 */
public class Formulario1 extends javax.swing.JPanel {
    
    ArrayList<persona> listapersonas =new ArrayList<persona>();
    modeloDatos tabla =new modeloDatos(listapersonas);
    boolean editando = false;
    int fila;
    
    JSONArray jsonArray = new JSONArray();
    String homeDir = System.getProperty("user.home");
    String desktopDir = homeDir + "/Desktop";
    String jsonName = "persona.json";
    String xmlName = "persona.xml";
    String filePathJson = desktopDir + "/" + jsonName;
    String filePathXML=desktopDir+"/"+xmlName;
    
    public void crearPersonaXML(){
        try {
            DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
            DocumentBuilder builder;
            builder = factory.newDocumentBuilder();
            DOMImplementation implementation= builder.getDOMImplementation();
    
            Document documento = implementation.createDocument(null, "Personas", null);
            documento.setXmlVersion("1.0");
            
            for(int i=0;i<this.listapersonas.size();i++){
            Element personas=documento.createElement("Usuario");
            
            Element id=(Element) documento.createElement("ID");
            id.appendChild(documento.createTextNode(this.listapersonas.get(i).getID()));
            personas.appendChild(id);
            
            Element nombre=(Element) documento.createElement("Nombre");
            nombre.appendChild(documento.createTextNode(this.listapersonas.get(i).getNombre()));
            personas.appendChild(nombre);
            
            Element apellido=(Element) documento.createElement("Apellido");
            apellido.appendChild(documento.createTextNode(this.listapersonas.get(i).getApellidos()));
            personas.appendChild(apellido);
            
            Element correo=(Element) documento.createElement("Correo");
            correo.appendChild(documento.createTextNode(this.listapersonas.get(i).getCorreo()));
            personas.appendChild(correo);
            
            Element year=(Element) documento.createElement("Year");
            year.appendChild(documento.createTextNode(this.listapersonas.get(i).getAñonac()));
            personas.appendChild(year);
            
            Element Password=(Element) documento.createElement("Password");
            Password.appendChild(documento.createTextNode(this.listapersonas.get(i).getPassword()));
            personas.appendChild(Password);
            
            documento.getDocumentElement().appendChild(personas);
            
            Source source = new DOMSource(documento);
            
            Result result = new StreamResult(new File(filePathXML));
            
            Transformer transformer = TransformerFactory.newInstance().newTransformer();
            transformer.transform(source, result);
            }
        } catch (ParserConfigurationException | TransformerException ex ) {
            Logger.getLogger(Formulario1.class.getName()).log(Level.SEVERE, null, ex);
        }
    
   
    }
    
    
    public Formulario1() throws ParserConfigurationException {
        
        initComponents();
        this.jTable1.setModel(tabla);  
    }
    
    private void crearpersonaJson(){
        for(persona persona:listapersonas){
            JSONObject jsonObject = new JSONObject();
            jsonObject.put("ID",persona.getID());
            jsonObject.put("Nombre",persona.getNombre());
            jsonObject.put("Apellido", persona.getApellidos());
            jsonObject.put("Correo", persona.getCorreo());
            jsonObject.put("Año de nacimiento", persona.getAñonac());
            jsonObject.put("Password", persona.getPassword());
            jsonArray.add(jsonObject);
        }
        try {
            FileWriter fileWriter = new FileWriter(filePathJson);
            fileWriter.write(jsonArray.toString());
            fileWriter.flush();
            fileWriter.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    
      
    private void limpiarCampos(){
         jTextID.setText("");
         jTextName.setText("");
         jTextMail.setText("");
         jTextLName.setText("");
         jTextYear.setText("");
         jPassword1.setText("");
    }
    
    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        jPanel2 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        jTextID = new javax.swing.JTextField();
        jLabel2 = new javax.swing.JLabel();
        jTextName = new javax.swing.JTextField();
        jLabel4 = new javax.swing.JLabel();
        jTextLName = new javax.swing.JTextField();
        jLabel3 = new javax.swing.JLabel();
        jTextMail = new javax.swing.JTextField();
        jLabel9 = new javax.swing.JLabel();
        jTextYear = new javax.swing.JTextField();
        jLabel7 = new javax.swing.JLabel();
        jPassword1 = new javax.swing.JPasswordField();
        jPanel3 = new javax.swing.JPanel();
        buttonIn = new javax.swing.JButton();
        buttonClean = new javax.swing.JButton();
        buttonDelete = new javax.swing.JButton();
        buttonModify = new javax.swing.JButton();
        buttonXML = new javax.swing.JButton();
        buttonJson = new javax.swing.JButton();
        jPanel4 = new javax.swing.JPanel();
        jPanel8 = new javax.swing.JPanel();
        jScrollPane1 = new javax.swing.JScrollPane();
        jTable1 = new javax.swing.JTable();

        setMinimumSize(new java.awt.Dimension(1000, 800));
        setPreferredSize(new java.awt.Dimension(1000, 800));

        jPanel1.setPreferredSize(new java.awt.Dimension(1000, 700));

        jPanel2.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        jLabel1.setText("ID");
        jPanel2.add(jLabel1, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 6, -1, -1));
        jPanel2.add(jTextID, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 28, 179, -1));

        jLabel2.setText("Nombre");
        jPanel2.add(jLabel2, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 56, -1, -1));
        jPanel2.add(jTextName, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 78, 179, -1));

        jLabel4.setText("Apellido");
        jPanel2.add(jLabel4, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 112, -1, -1));
        jPanel2.add(jTextLName, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 134, 179, -1));

        jLabel3.setText("Correo");
        jPanel2.add(jLabel3, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 162, -1, -1));
        jPanel2.add(jTextMail, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 184, 179, -1));

        jLabel9.setText("Año de Nacimiento");
        jPanel2.add(jLabel9, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 212, -1, -1));
        jPanel2.add(jTextYear, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 234, 179, -1));

        jLabel7.setText("Contraseña");
        jPanel2.add(jLabel7, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 262, -1, -1));

        jPassword1.setToolTipText("Introduce la contraseña aquí");
        jPassword1.setMaximumSize(new java.awt.Dimension(64, 22));
        jPanel2.add(jPassword1, new org.netbeans.lib.awtextra.AbsoluteConstraints(35, 284, 179, -1));

        jPanel3.setLayout(new org.netbeans.lib.awtextra.AbsoluteLayout());

        buttonIn.setText("Insertar");
        buttonIn.setToolTipText("Insertar los datos introducidos");
        buttonIn.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonInActionPerformed(evt);
            }
        });
        jPanel3.add(buttonIn, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 10, 105, 75));

        buttonClean.setText("Limpiar");
        buttonClean.setToolTipText("Pulsa para borrar los datos introducidos");
        buttonClean.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonCleanActionPerformed(evt);
            }
        });
        jPanel3.add(buttonClean, new org.netbeans.lib.awtextra.AbsoluteConstraints(120, 10, 105, 75));

        buttonDelete.setText("Borrar");
        buttonDelete.setToolTipText("Pulsa para borrar  los datos ");
        buttonDelete.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonDeleteActionPerformed(evt);
            }
        });
        jPanel3.add(buttonDelete, new org.netbeans.lib.awtextra.AbsoluteConstraints(120, 90, 105, 75));

        buttonModify.setText("Modificar");
        buttonModify.setToolTipText("Pulsa para modificar los datos ");
        buttonModify.setMaximumSize(new java.awt.Dimension(72, 23));
        buttonModify.setMinimumSize(new java.awt.Dimension(72, 23));
        buttonModify.setPreferredSize(new java.awt.Dimension(72, 23));
        buttonModify.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonModifyActionPerformed(evt);
            }
        });
        jPanel3.add(buttonModify, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 90, 105, 75));

        buttonXML.setText("XML");
        buttonXML.setToolTipText("Exporta los datos a XML");
        buttonXML.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonXMLActionPerformed(evt);
            }
        });
        jPanel3.add(buttonXML, new org.netbeans.lib.awtextra.AbsoluteConstraints(10, 170, 105, 75));

        buttonJson.setText("JSON");
        buttonJson.setToolTipText("Exporta a JSon");
        buttonJson.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                buttonJsonActionPerformed(evt);
            }
        });
        jPanel3.add(buttonJson, new org.netbeans.lib.awtextra.AbsoluteConstraints(120, 170, 105, 75));

        javax.swing.GroupLayout jPanel8Layout = new javax.swing.GroupLayout(jPanel8);
        jPanel8.setLayout(jPanel8Layout);
        jPanel8Layout.setHorizontalGroup(
            jPanel8Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 691, Short.MAX_VALUE)
        );
        jPanel8Layout.setVerticalGroup(
            jPanel8Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGap(0, 637, Short.MAX_VALUE)
        );

        jTable1.setAutoCreateRowSorter(true);
        jTable1.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {

            },
            new String [] {
                "ID", "Nombre", "Apellido", "Correo", "Año ", "Contraseña"
            }
        ));
        jTable1.setColumnSelectionAllowed(true);
        jTable1.addMouseListener(new java.awt.event.MouseAdapter() {
            public void mouseClicked(java.awt.event.MouseEvent evt) {
                jTable1MouseClicked(evt);
            }
        });
        jScrollPane1.setViewportView(jTable1);
        jTable1.getColumnModel().getSelectionModel().setSelectionMode(javax.swing.ListSelectionModel.SINGLE_SELECTION);

        javax.swing.GroupLayout jPanel4Layout = new javax.swing.GroupLayout(jPanel4);
        jPanel4.setLayout(jPanel4Layout);
        jPanel4Layout.setHorizontalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel4Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(jPanel8, javax.swing.GroupLayout.Alignment.TRAILING, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jScrollPane1, javax.swing.GroupLayout.DEFAULT_SIZE, 691, Short.MAX_VALUE))
                .addContainerGap())
        );
        jPanel4Layout.setVerticalGroup(
            jPanel4Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel4Layout.createSequentialGroup()
                .addGap(54, 54, 54)
                .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 625, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(jPanel8, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addContainerGap())
        );

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGap(12, 12, 12)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addComponent(jPanel2, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addComponent(jPanel3, javax.swing.GroupLayout.DEFAULT_SIZE, 248, Short.MAX_VALUE))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(jPanel4, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                .addContainerGap())
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addGap(54, 54, 54)
                        .addComponent(jPanel2, javax.swing.GroupLayout.PREFERRED_SIZE, 318, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                        .addComponent(jPanel3, javax.swing.GroupLayout.PREFERRED_SIZE, 309, javax.swing.GroupLayout.PREFERRED_SIZE))
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addContainerGap()
                        .addComponent(jPanel4, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(this);
        this.setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, 981, Short.MAX_VALUE)
                .addGap(13, 13, 13))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, 1340, Short.MAX_VALUE)
        );
    }// </editor-fold>//GEN-END:initComponents

    private void jTable1MouseClicked(java.awt.event.MouseEvent evt) {//GEN-FIRST:event_jTable1MouseClicked
        // TODO add your handling code here:
        fila=this.jTable1.getSelectedRow();
        var persona = (persona) this.listapersonas.get(fila);
        jTextID.setText(persona.getID());
        jTextName.setText(persona.getNombre());
        jTextLName.setText(persona.getApellidos());
        jTextMail.setText(persona.getCorreo());
        jTextYear.setText(persona.getAñonac());
        jPassword1.setText(persona.getPassword());
    }//GEN-LAST:event_jTable1MouseClicked

    private void buttonJsonActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonJsonActionPerformed
        crearpersonaJson();
    }//GEN-LAST:event_buttonJsonActionPerformed

    private void buttonXMLActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonXMLActionPerformed
        // TODO add your handling code here:
        crearPersonaXML();
    }//GEN-LAST:event_buttonXMLActionPerformed

    private void buttonModifyActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonModifyActionPerformed
        editando=true;
        persona p =new persona();
        p.setID(jTextID.getText());
        p.setNombre(jTextName.getText());
        p.setApellidos(jTextLName.getText());
        p.setCorreo(jTextMail.getText());
        p.setañoNac(jTextYear.getText());
        p.setPassword(jPassword1.getText());
        tabla.setValueRow(p, fila);
        limpiarCampos();
         
    }//GEN-LAST:event_buttonModifyActionPerformed
    
    private void buttonDeleteActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonDeleteActionPerformed
        int rowIndex = jTable1.getSelectedRow();
        if (rowIndex >= 0) {
            tabla.removeRow(rowIndex);
            limpiarCampos();
        }
    }//GEN-LAST:event_buttonDeleteActionPerformed
    //boton para limpiar los campos
    private void buttonCleanActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonCleanActionPerformed
        // borramos los campos simplemente
        limpiarCampos();
    }//GEN-LAST:event_buttonCleanActionPerformed

    private void buttonInActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_buttonInActionPerformed
        // metemos los datos dentro del arraylist usando la clase persona ya predefinida anteriormente
        persona p =new persona();
        p.setID(jTextID.getText());
        p.setNombre(jTextName.getText());
        p.setApellidos(jTextLName.getText());
        p.setCorreo(jTextMail.getText());
        p.setañoNac(jTextYear.getText());
        p.setPassword(jPassword1.getText());
        listapersonas.add(p);
        tabla.setListaPersonas(listapersonas);
        limpiarCampos();

    }//GEN-LAST:event_buttonInActionPerformed


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton buttonClean;
    private javax.swing.JButton buttonDelete;
    private javax.swing.JButton buttonIn;
    private javax.swing.JButton buttonJson;
    private javax.swing.JButton buttonModify;
    private javax.swing.JButton buttonXML;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JLabel jLabel7;
    private javax.swing.JLabel jLabel9;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JPanel jPanel2;
    private javax.swing.JPanel jPanel3;
    private javax.swing.JPanel jPanel4;
    private javax.swing.JPanel jPanel8;
    private javax.swing.JPasswordField jPassword1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JTable jTable1;
    private javax.swing.JTextField jTextID;
    private javax.swing.JTextField jTextLName;
    private javax.swing.JTextField jTextMail;
    private javax.swing.JTextField jTextName;
    private javax.swing.JTextField jTextYear;
    // End of variables declaration//GEN-END:variables

   
}
