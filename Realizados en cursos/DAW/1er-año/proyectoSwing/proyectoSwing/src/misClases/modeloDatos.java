package misClases;

import java.util.ArrayList;
import javax.swing.table.AbstractTableModel;

/**
 *
 * @author Cano
 */
public class modeloDatos extends AbstractTableModel{
    
    private static final int DNI=0;
    private static final int NOMBRE=1;
    private static final int APELLIDOS=2;
    private static final int CORREO=3;
    private static final int YEAR=4;
    private static final int PASSWORD=5;
    
    private ArrayList<persona> listapersonas;
    
    private static final String[] columns = new String[]{"ID", "Nombre", "Apellidos", "Correo", "Año de nacimiento", "Contraseña"};
    private static final Class<?>[] clase ={String.class,String.class,String.class,String.class,String.class,String.class};
    
    private String[] columnNames = {"ID", "Nombre", "Apellidos", "Correo", "Año de nacimiento", "Contraseña"};

    public modeloDatos(ArrayList<persona> listapersonas){
        this.listapersonas=listapersonas;
    }
     
    @Override
    public int getRowCount() {
        return listapersonas.size();
    }

    @Override
    public int getColumnCount() {
        return columns.length;
    }
    
       
    @Override  // Devuelve valor de la celda que s esta en la fila rowIndex y en la columna columnIndex
    public Object getValueAt(int rowIndex, int columnIndex) {
        persona a = getPersona(rowIndex);

        if(a != null) {
            switch (columnIndex) {
                case DNI:
                    return a.getID();
                case NOMBRE:
                    return a.getNombre();
                case APELLIDOS:
                    return a.getApellidos();
                case CORREO:
                    return a.getCorreo();
                 case YEAR:
                    return a.getAñonac();
                case PASSWORD:
                    return a.getPassword();
               }
        }
        return "";
    }
    
    @Override  // Escribe valor en la celda que esta en la fila rowIndex y en la columna columnIndex
    public void setValueAt(Object valor,int rowIndex, int columnIndex) {
        persona a = getPersona(rowIndex);

        if(a != null) {
            switch (columnIndex) {
                case DNI:
                     a.setID(valor.toString());
                case NOMBRE:
                     a.setNombre(valor.toString());
                case APELLIDOS:
                     a.setApellidos(valor.toString());
                case CORREO:
                     a.setCorreo(valor.toString());
                 case YEAR:
                     a.setañoNac(valor.toString());
                case PASSWORD:
                     a.setPassword(valor.toString());
                
               }
        }
       
    }
    
    
    public void setValueRow(persona a,int rowIndex) {
        persona modificar = getPersona(rowIndex);

        if(modificar != null) {
            modificar.setID(a.getID());
            modificar.setNombre(a.getNombre());
            modificar.setApellidos(a.getApellidos());
            modificar.setCorreo(a.getCorreo());
            modificar.setañoNac(a.getAñonac());
            modificar.setPassword(a.getPassword());
            this.fireTableDataChanged();
           }
    }
  
    
    public persona getPersona(int rowIndex) {
        if (getRowCount() > rowIndex && rowIndex >= 0) {
            return listapersonas.get(rowIndex);
        }
        return null;
    }

    public ArrayList<persona> getlistaPersonas() {
        return listapersonas;
    }

    public void setListaPersonas(ArrayList<persona> listaPersonas) {
        this.listapersonas = listaPersonas;
        this.fireTableDataChanged(); //informa que la tabla ha cambiado.
    }

    public void setPersona(persona sb){
        listapersonas.add(sb);
        this.fireTableRowsInserted(listapersonas.size()-1, listapersonas.size()-1);
    }
   @Override
    public Class<?> getColumnClass(int columnIndex) {
        return clase[columnIndex];
    }
    
    @Override 
    public String getColumnName(int index) { 
        return columnNames[index]; 
    } 

   
    public String[] getColumnNames() {
        return columnNames;
    }

    public void setColumnNames(String[] columnNames) {
        this.columnNames = columnNames;
    }
    
     public void removeRow(int rowIndex) {
        listapersonas.remove(rowIndex);
        fireTableDataChanged();
    }
    
}
