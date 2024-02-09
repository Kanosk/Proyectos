package com.example.Candido;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.data.jpa.repository.config.EnableJpaAuditing;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.context.annotation.ComponentScan;

@SpringBootApplication
@EnableJpaAuditing
@ComponentScan
@RestController
public class CandidoApplication {

    @GetMapping("/hello")
    public String hola(){
        return "Hola Mundo, esto es una prueba";
    }
    @GetMapping("/api/v1")
    public String Hello(){
        return "Hello Api";
    }
    
	public static void main(String[] args) {
		SpringApplication.run(CandidoApplication.class, args);
	}

}
