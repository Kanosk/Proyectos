/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.services;


import com.example.Candido.repositories.*;
import com.example.Candido.models.*;
import com.example.Candido.exceptions.NotFoundException;
import java.util.ArrayList;
import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 *
 * @author Cano
 */
@Service
public class ProductService {

    @Autowired
    private ProductRepository ProductRepository;

    public List<Product> getAllProducts() {
        return ProductRepository.findAll();
    }

    public Product getProductById(Long id) {
        return ProductRepository.findById(id)
                .orElseThrow(() -> new NotFoundException("Product not found with ID: "+ id));
    }
    

    public Product createProduct(Product newProduct) {
        return ProductRepository.save(newProduct);
    }

    public Product updateProduct(Product updatedProduct) {
        return ProductRepository.save(updatedProduct);
    }

    public void deleteProduct(Long id) {
        ProductRepository.deleteById(id);
    } 
     public List<Product> getProductsByPriceRange(double minPrice, double maxPrice) {
        List<Product> productsInPriceRange = new ArrayList<>();
        for (Product product : ProductRepository.findAll()) {
            if (product.getPrecio() >= minPrice && product.getPrecio() <= maxPrice) {
                productsInPriceRange.add(product);
            }
        }
        return productsInPriceRange;
    }
}
