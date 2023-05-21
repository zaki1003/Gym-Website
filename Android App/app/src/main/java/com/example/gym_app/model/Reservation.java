package com.example.gym_app.model;

public class Reservation {
   private String training_session_name;
    private String training_session_date;
    private String reservation_date;
    private String reservation_time;
    private String name;
    private String email;


    // Getter Methods

    public String getTraining_session_name() {
        return training_session_name;
    }

    public String getTraining_session_date() {
        return training_session_date;
    }

    public String getReservation_date() {
        return reservation_date;
    }

    public String getReservation_time() {
        return reservation_time;
    }

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    // Setter Methods

    public void setTraining_session_name(String training_session_name) {
        this.training_session_name = training_session_name;
    }

    public void setTraining_session_date(String training_session_date) {
        this.training_session_date = training_session_date;
    }

    public void setReservation_date(String reservation_date) {
        this.reservation_date = reservation_date;
    }

    public void setReservation_time(String reservation_time) {
        this.reservation_time = reservation_time;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setEmail(String email) {
        this.email = email;
    }
}