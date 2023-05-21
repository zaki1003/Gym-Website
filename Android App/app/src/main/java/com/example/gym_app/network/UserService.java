package com.example.gym_app.network;
import com.example.gym_app.model.LoginRequest;
import com.example.gym_app.model.LoginResponse;
import com.example.gym_app.model.ApiResponse;
import com.example.gym_app.model.RegisterRequest;
import com.example.gym_app.model.Reservation;
import com.example.gym_app.model.Session;

import java.util.List;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.PUT;
import retrofit2.http.Path;

public interface UserService {

    @Headers({"Accept: application/json"})
    @POST("signin")
    Call<LoginResponse> userLogin(@Body LoginRequest loginRequest);

    @Headers({"Accept: application/json"})
    @POST("signup")
    Call<LoginResponse> userRegister(@Body RegisterRequest registerRequest);



    @GET("logout")
    Call<ApiResponse> logout();





    @GET("TrainingSessions")
    Call<List<Session>> getAllSessions();


    @GET("get_reservations")
    Call<List<Reservation>> getReservations();


    @DELETE("TrainingSessions/{session}")
    Call<ApiResponse> deleteSession(@Path("session") String session);



    @POST("createSession")
    Call<ApiResponse> createSession(@Body Session session);


    @PUT("TrainingSessions/{session}")
    Call<ApiResponse> updateSession(@Path("session") String sessionId,@Body Session session);



    @POST("reserveSession/{session}")
    Call<ApiResponse> reserveSession(@Path("session") String sessionId);


}