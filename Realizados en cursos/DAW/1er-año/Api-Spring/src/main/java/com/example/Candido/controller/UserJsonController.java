/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.controller;

import com.example.Candido.models.UserJson;
import java.util.ArrayList;
import java.util.List;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

/**
 *
 * @author Cano
 */
@RestController
@RequestMapping ("/api/v1/usersJSON")
public class UserJsonController {
    
    @GetMapping
    @ResponseBody
    public List<UserJson> getUsers(){
        List<UserJson> users = new ArrayList<>();
        users.add(new UserJson(1,"John Doe","john@example.es"));
        users.add(new UserJson(2, "Mery Doe", "mery@example.es"));
        return users;
    }
}
