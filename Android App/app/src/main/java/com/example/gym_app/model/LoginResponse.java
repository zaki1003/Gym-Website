package com.example.gym_app.model;


import com.example.gym_app.model.User;

public class LoginResponse {
    private User user;
    private String role;
    private String token;


    public User getUser() { return user; }
    public void setUser(User value) { this.user = value; }

    public String getRole() { return role; }
    public void setRole(String value) { this.role = value; }

    public String getToken() { return token; }
    public void setToken(String value) { this.token = value; }
}
