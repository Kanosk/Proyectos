package com.example.Candido.repositories;
import com.example.Candido.models.*;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ProductRepository extends JpaRepository<Product, Long>{
    // All CRUD Database METHODS
}