package com.example.gym_app.activity;

import androidx.appcompat.app.AppCompatActivity;

import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Intent;

import android.os.Bundle;



import android.widget.Toast;


import com.example.gym_app.R;
import com.example.gym_app.adapter.ReservationAdapter;

import com.example.gym_app.model.Reservation;

import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.example.gym_app.network.UserService;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ReservationActivity extends AppCompatActivity {

    private ReservationAdapter adapter;
    private RecyclerView recyclerView;
    ProgressDialog progressDoalog;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reservation);


        //--------------ToolBar


        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar_reservation);
        toolbar.setNavigationIcon(null);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(false);

        //  toolbar.setNavigationIcon(null);

        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(false);
            getSupportActionBar().setHomeButtonEnabled(false);
        }
        //------------------



        UserData x = UserData.getInstance();
        String   role = x.role;



        progressDoalog = new ProgressDialog(ReservationActivity.this);
        progressDoalog.setMessage("Chargement....");
        progressDoalog.show();
        Intent intent = getIntent();
        String token = intent.getStringExtra("token");
        /*Create handle for the RetrofitInstance interface*/
        System.out.println("-------------------- token -----------" + token );
        UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);

        Call<List<Reservation>> call = service.getReservations();
        call.enqueue(new Callback<List<Reservation>>() {

            @Override
            public void onResponse(Call<List<Reservation>> call, Response<List<Reservation>> response) {
                progressDoalog.dismiss();
                generateDataList(response.body(),token);
                System.out.println("-------------------- response -----------" + response.body());
            }

            @Override
            public void onFailure(Call<List<Reservation>> call, Throwable t) {
                progressDoalog.dismiss();
                Toast.makeText(ReservationActivity.this, "Une erreur s'est produite... Veuillez réessayer plus tard !", Toast.LENGTH_SHORT).show();
            }
        });



    }

    /*Method to generate List of data using RecyclerView with custom adapter*/
    private void generateDataList(List<Reservation> photoList, String token) {
        recyclerView = findViewById(R.id.customRecyclerView);
        adapter = new ReservationAdapter(this,photoList,token,this);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(ReservationActivity.this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapter);
    }

}