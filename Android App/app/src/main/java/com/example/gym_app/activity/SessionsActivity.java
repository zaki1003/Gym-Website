package com.example.gym_app.activity;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Intent;
import android.view.View;
import android.os.Bundle;

import android.widget.Button;

import android.widget.TextView;


import android.widget.Toast;


import com.example.gym_app.R;
import com.example.gym_app.adapter.SessionAdapter;
import com.example.gym_app.model.Session;
import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.example.gym_app.network.UserService;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class SessionsActivity extends AppCompatActivity {

    private SessionAdapter adapter;
    private RecyclerView recyclerView;
    ProgressDialog progressDoalog;

     Button btn_add,btn_home;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sessions);


        UserData x = UserData.getInstance();
        String role = x.role;


        //--------------ToolBar


        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setNavigationIcon(null);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(false);

        //  toolbar.setNavigationIcon(null);

        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayHomeAsUpEnabled(false);
            getSupportActionBar().setHomeButtonEnabled(false);
        }
        //------------------


        progressDoalog = new ProgressDialog(SessionsActivity.this);
        progressDoalog.setMessage("Chargement....");
        progressDoalog.show();
        Intent intent = getIntent();
        String token = intent.getStringExtra("token");
        /*Create handle for the RetrofitInstance interface*/
        System.out.println("-------------------- token -----------" + token);
        UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);

        Call<List<Session>> call = service.getAllSessions();
        call.enqueue(new Callback<List<Session>>() {

            @Override
            public void onResponse(Call<List<Session>> call, Response<List<Session>> response) {
                progressDoalog.dismiss();
                generateDataList(response.body(), token);
                System.out.println("-------------------- response -----------" + response.body());
            }

            @Override
            public void onFailure(Call<List<Session>> call, Throwable t) {
                progressDoalog.dismiss();
                Toast.makeText(SessionsActivity.this, "Une erreur s'est produite... Veuillez réessayer plus tard !", Toast.LENGTH_SHORT).show();
            }
        });


        btn_add = findViewById(R.id.btn_add);

        btn_home = findViewById(R.id.btn_home);
        TextView title = findViewById(R.id.title);
        if (role.contains("user")) {
            btn_add.setVisibility(View.GONE);
            title.setText("Les séances");
        }

        btn_add.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                startActivity(new Intent(SessionsActivity.this, AddSessionActivity.class).putExtra("token", token));

            }
        });


        btn_home.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                startActivity(new Intent(SessionsActivity.this, DashboardActivity.class).putExtra("token", token));

            }
        });

    }
    /*Method to generate List of data using RecyclerView with custom adapter*/
    private void generateDataList(List<Session> photoList, String token) {
        recyclerView = findViewById(R.id.customRecyclerView);
        adapter = new SessionAdapter(this,photoList,token,this);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(SessionsActivity.this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapter);
    }

}