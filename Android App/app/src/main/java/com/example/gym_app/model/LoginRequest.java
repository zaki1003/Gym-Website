package com.example.gym_app.model;
public class LoginRequest {

    private String email;
    private String password;
    private String device_name;



    public String getUsername() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getDeviceName() {
        return device_name;
    }

    public void setDeviceName(String deviceName) {
        this.device_name = deviceName;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
}