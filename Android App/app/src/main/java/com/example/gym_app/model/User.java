package com.example.gym_app.model;

import java.util.Date;

public class User {
    private long id;
    private String name;
    private String email;
    private long isVerifications;
    private Date emailVerifiedAt;
    private String nationalID;
    private String gender;
    private String profileImage;
    private Date birthDate;
    private Date subscriptionStart;
    private Date subscriptionEnd;
    private Date lastLoginAt;
    private Object deletedAt;
    private Date createdAt;
    private Date updatedAt;
    private Object bannedAt;

    public long getID() { return id; }
    public void setID(long value) { this.id = value; }

    public String getName() { return name; }
    public void setName(String value) { this.name = value; }

    public String getEmail() { return email; }
    public void setEmail(String value) { this.email = value; }

    public long getIsVerifications() { return isVerifications; }
    public void setIsVerifications(long value) { this.isVerifications = value; }

    public Date getEmailVerifiedAt() { return emailVerifiedAt; }
    public void setEmailVerifiedAt(Date value) { this.emailVerifiedAt = value; }

    public String getNationalID() { return nationalID; }
    public void setNationalID(String value) { this.nationalID = value; }

    public String getGender() { return gender; }
    public void setGender(String value) { this.gender = value; }

    public String getProfileImage() { return profileImage; }
    public void setProfileImage(String value) { this.profileImage = value; }

    public Date getBirthDate() { return birthDate; }
    public void setBirthDate(Date value) { this.birthDate = value; }

    public Date getSubscriptionStart() { return subscriptionStart; }
    public void setSubscriptionStart(Date value) { this.subscriptionStart = value; }

    public Date getSubscriptionEnd() { return subscriptionEnd; }
    public void setSubscriptionEnd(Date value) { this.subscriptionEnd = value; }

    public Date getLastLoginAt() { return lastLoginAt; }
    public void setLastLoginAt(Date value) { this.lastLoginAt = value; }

    public Object getDeletedAt() { return deletedAt; }
    public void setDeletedAt(Object value) { this.deletedAt = value; }

    public Date getCreatedAt() { return createdAt; }
    public void setCreatedAt(Date value) { this.createdAt = value; }

    public Date getUpdatedAt() { return updatedAt; }
    public void setUpdatedAt(Date value) { this.updatedAt = value; }

    public Object getBannedAt() { return bannedAt; }
    public void setBannedAt(Object value) { this.bannedAt = value; }
}