/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.services;


import com.example.Candido.repositories.*;
import com.example.Candido.models.*;
import com.example.Candido.exceptions.NotFoundException;
import jakarta.persistence.EntityManager;
import jakarta.persistence.Query;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;


/**
 *
 * @author Cano
 */
@Service
public class OrderService {
    
    @Autowired
    private EntityManager entityManager;
    private OrderRepository OrderRepository;

    public List<Order> getAllOrders() {
        return OrderRepository.findAll();
    }

    public Order getOrderById(Long id) {
        return OrderRepository.findById(id)
                .orElseThrow(() -> new NotFoundException("Product not found with ID: "+ id));
    }
    

    public Order createOrder(Order newOrder) {
        return OrderRepository.save(newOrder);
    }

    public Order updateOrder(Order updatedOrder) {
        return OrderRepository.save(updatedOrder);
    }

    public void deleteOrder(Long id) {
        OrderRepository.deleteById(id);
    } 
    public List<Product> getOrderedProductsByUserId(Long userId) {
    String sql = "SELECT p.* "
        + "FROM Orders o "
        + "JOIN Productos p ON o.producto_id = p.id "
        + "WHERE o.usuario_id = :userId";
    Query query = entityManager.createNativeQuery(sql, Product.class);
    query.setParameter("userId", userId);
    return query.getResultList();
    }
}
