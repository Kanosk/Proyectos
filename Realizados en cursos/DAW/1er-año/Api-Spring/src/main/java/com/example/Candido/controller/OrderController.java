/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.controller;

/**
 *
 * @author Cano
 */
import com.example.Candido.models.*;
import com.example.Candido.services.*;
import com.example.Candido.exceptions.NotFoundException;
import java.net.URI;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@CrossOrigin("*")
@RestController
@RequestMapping("/api/v1")
@ComponentScan
@SpringBootApplication
public class OrderController {
  @Autowired
    private OrderService OrderService;

    @GetMapping("/orders")
    public List<Order> getAllOrders() {
        return OrderService.getAllOrders();
    }

    @GetMapping("/orders/{id}")
    public ResponseEntity<Order> getOrderById(@PathVariable("id") Long id) {
        try {
            Order order = OrderService.getOrderById(id);
            return ResponseEntity.ok(order);
        } catch (NotFoundException e) {
            return ResponseEntity.notFound().build();
        }
    }

    @PostMapping("/orders")
    public ResponseEntity<Order> createOrder(@RequestBody Order order) {
        Order createdOrder = OrderService.createOrder(order);
        return ResponseEntity.created(URI.create("/api/v1/orders/" + createdOrder.getId())).body(createdOrder);
    }

    @PutMapping("/orders/{id}")
    public ResponseEntity<Order> updateOrder(@PathVariable("id") Long id, @RequestBody Order order) {
        Order updateOrder = OrderService.updateOrder(order);
        return ResponseEntity.ok(updateOrder);
    }
   
    @PatchMapping("/orders/{id}")
    public ResponseEntity<Order> updatePatchUser(@PathVariable("id") Long id, @RequestBody Order order) {
        Order patchedOrder = OrderService.updateOrder(order);
        return ResponseEntity.ok(patchedOrder);
    }

    @DeleteMapping("/orders/{id}")
    public ResponseEntity<Void> deleteOrder(@PathVariable("id") Long id) {
        OrderService.deleteOrder(id);
        return ResponseEntity.noContent().build();
    }
    
    @GetMapping("/users/{userId}/orders")
    public List<Product> getOrderedProductsByUserId(@PathVariable Long userId) {
        return OrderService.getOrderedProductsByUserId(userId);
    }
}
