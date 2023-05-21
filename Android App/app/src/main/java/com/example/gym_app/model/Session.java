package com.example.gym_app.model;

import java.io.Serializable;

/*
import java.util.Date;

public class Session {
    private String coachName;
    private String id;
    private String name;
    private Date day;
    private String startsAt;
    private String finishesAt;
    private Date updatedAt;
    private Date createdAt;
    private Object deletedAt;

    public String getCoachName() { return coachName; }
    public void setCoachName(String value) { this.coachName = value; }

    public String getID() { return id; }
    public void setID(String value) { this.id = value; }

    public String getName() { return name; }
    public void setName(String value) { this.name = value; }

    public Date getDay() { return day; }
    public void setDay(Date value) { this.day = value; }

    public String getStartsAt() { return startsAt; }
    public void setStartsAt(String value) { this.startsAt = value; }

    public String getFinishesAt() { return finishesAt; }
    public void setFinishesAt(String value) { this.finishesAt = value; }

    public Date getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(Date value) { this.updatedAt = value; }

    public Date getCreatedAt() { return createdAt; }
    public void setCreatedAt(Date value) { this.createdAt = value; }

    public Object getDeletedAt() { return deletedAt; }
    public void setDeletedAt(Object value) { this.deletedAt = value; }
}
*/
public class Session implements Serializable {
    private String coach_name;
    private String id;
    private String name;
    private String day;
    private String starts_at;
    private String finishes_at;
    private String updated_at;
    private String created_at;
    private String deleted_at = null;


    // Getter Methods

    public String getCoach_name() {
        return coach_name;
    }

    public String getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getDay() {
        return day;
    }

    public String getStarts_at() {
        return starts_at;
    }

    public String getFinishes_at() {
        return finishes_at;
    }

    public String getUpdated_at() {
        return updated_at;
    }

    public String getCreated_at() {
        return created_at;
    }

    public String getDeleted_at() {
        return deleted_at;
    }

    // Setter Methods

    public void setCoach_name(String coach_name) {
        this.coach_name = coach_name;
    }

    public void setId(String id) {
        this.id = id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setDay(String day) {
        this.day = day;
    }

    public void setStarts_at(String starts_at) {
        this.starts_at = starts_at;
    }

    public void setFinishes_at(String finishes_at) {
        this.finishes_at = finishes_at;
    }

    public void setUpdated_at(String updated_at) {
        this.updated_at = updated_at;
    }

    public void setCreated_at(String created_at) {
        this.created_at = created_at;
    }

    public void setDeleted_at(String deleted_at) {
        this.deleted_at = deleted_at;
    }
}