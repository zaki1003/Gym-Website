package com.example.gym_app.model;
public class UserData {
    // Static variable reference of single_instance
    // of type Token
    private static UserData single_instance = null;

    // Declaring a variable of type String
    public String token;
    public String role;
    // Constructor
    // Here we will be creating private constructor
    // restricted to this class itself
    private UserData()
    {
        token = " Token ";
        role = "Role";
    }

    // Static method
    // Static method to create instance of Token class
    public static synchronized UserData getInstance()
    {
        if (single_instance == null)
            single_instance = new UserData();

        return single_instance;
    }
}