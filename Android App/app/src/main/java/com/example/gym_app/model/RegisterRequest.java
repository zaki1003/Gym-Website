package com.example.gym_app.model;

public class RegisterRequest {
  private String name;
    private String email;
    private String password;
    private String password_confirmation;
    private String device_name;


    // Getter Methods

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public String getPassword() {
        return password;
    }

    public String getPassword_confirmation() {
        return password_confirmation;
    }

    public String getDevice_name() {
        return device_name;
    }

    // Setter Methods

    public void setName(String name) {
        this.name = name;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setPassword_confirmation(String password_confirmation) {
        this.password_confirmation = password_confirmation;
    }

    public void setDevice_name(String device_name) {
        this.device_name = device_name;
    }
}