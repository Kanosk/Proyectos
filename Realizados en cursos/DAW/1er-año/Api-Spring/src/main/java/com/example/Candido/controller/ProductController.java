/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.example.Candido.controller;

import com.example.Candido.models.*;
import com.example.Candido.services.*;
import com.example.Candido.exceptions.NotFoundException;
import java.net.URI;
import java.util.Comparator;
import java.util.List;
import java.util.stream.Collectors;
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
public class ProductController {

    @Autowired
    private ProductService productService;

    @GetMapping("/product")
    public List<Product> getAllProducts() {
        return productService.getAllProducts();
    }

    @GetMapping("/product/{id}")
    public ResponseEntity<Product> getProductById(@PathVariable("id") Long id) {
        try {
            Product Product = productService.getProductById(id);
            return ResponseEntity.ok(Product);
        } catch (NotFoundException e) {
            return ResponseEntity.notFound().build();
        }
    }
   

    @PostMapping("/product")
    public ResponseEntity<Product> createProduct(@RequestBody Product product) {
        Product createdProduct = productService.createProduct(product);
        return ResponseEntity.created(URI.create("/api/v1/products/" + createdProduct.getId())).body(createdProduct);
    }

    @PutMapping("/product/{id}")
    public ResponseEntity<Product> updateProduct(@PathVariable("id") Long id, @RequestBody Product product) {
        Product updatedProduct = productService.updateProduct(product);
        return ResponseEntity.ok(updatedProduct);
    }

    @PatchMapping("/product/{id}")
    public ResponseEntity<Product> updatePatchProduct(@PathVariable("id") Long id, @RequestBody Product product) {
        Product patchedProduct = productService.updateProduct(product);
        return ResponseEntity.ok(patchedProduct);
    }

    @DeleteMapping("/product/{id}")
    public ResponseEntity<Void> deleteProduct(@PathVariable("id") Long id) {
        productService.deleteProduct(id);
        return ResponseEntity.noContent().build();
    }
    @GetMapping("/products")
public List<Product> filterProducts(@RequestParam(required = false) String name,
                                     @RequestParam(required = false) Double priceGreaterThan,
                                     @RequestParam(required = false, defaultValue = "asc") String sortBy) {
    List<Product> products = productService.getAllProducts();

    if (name != null) {
        products = products.stream()
                            .filter(product -> product.getName().equals(name))
                            .collect(Collectors.toList());
    }

    if (priceGreaterThan != null) {
        products = products.stream()
                            .filter(product -> product.getPrecio() > priceGreaterThan)
                            .collect(Collectors.toList());
    }

    if (sortBy.equals("asc")) {
        products = products.stream()
                            .sorted(Comparator.comparing(Product::getPrecio))
                            .collect(Collectors.toList());
    } else if (sortBy.equals("desc")) {
        products = products.stream()
                            .sorted(Comparator.comparing(Product::getPrecio).reversed())
                            .collect(Collectors.toList());
    }

    return products;
}
}
