/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.models;
import jakarta.persistence.*;
import org.springframework.data.jpa.domain.support.AuditingEntityListener;

/**
 *
 * @author Cano
 */
@Entity
@Table(name = "orders")
@EntityListeners(AuditingEntityListener.class)
public class Order {
    @Id
    @GeneratedValue(strategy =GenerationType.IDENTITY)
    private long id;
     @Column(name = "usuario_id")
    private int usuario_id;
    @Column(name = "producto_id")
    private int producto_id;
    @Column(name = "fecha_creacion")
    private String fecha_creacion;
    
    public Order(){}
    public Order(long id, int usuario_id, int producto_id, String fecha_creacion){
        this.id=id;
        this.usuario_id=usuario_id;
        this.producto_id=producto_id;
        this.fecha_creacion=fecha_creacion;
    }
     public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }
    
    public int getUsuarioId(){
        return usuario_id;
    }
    public void setUsuarioId(int usuario_id){
        this.usuario_id=usuario_id;
    }
    
    public int getProductoId(){
        return producto_id;
    }
    public void setProductoId(int producto_id){
        this.producto_id=producto_id;
    }
    public String getFecha(){
        return fecha_creacion;
    }
    public void setFecha(String fecha_creacion){
        this.fecha_creacion=fecha_creacion;
    }
    
}
