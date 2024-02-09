/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.models;

/**
 *
 * @author Cano
 */
public class UserJson {
    private int id;
    private String name;
    private String mail;
    
    public UserJson(){}
    
    public UserJson(int id, String name, String mail){
        this.id=id;
        this.name=name;
        this.mail=mail;
    }
    public int getId(){
        return id;
    }
    public void setId(int id){
        this.id=id;
    }
     public String getName(){
        return name;
    }
    public void setName(String name){
        this.name=name;
    }
     public String getMail(){
        return mail;
    }
    public void setMail(String mail){
        this.mail=mail;
    }
    
}
