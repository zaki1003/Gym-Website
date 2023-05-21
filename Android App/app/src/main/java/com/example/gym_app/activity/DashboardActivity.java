package com.example.gym_app.activity;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gym_app.R;
import com.example.gym_app.model.ApiResponse;
import com.example.gym_app.model.LoginRequest;
import com.example.gym_app.model.LoginResponse;
import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.example.gym_app.network.UserService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class DashboardActivity extends AppCompatActivity {

    TextView name;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dasboard);
        Intent intent = getIntent();
        String token = intent.getStringExtra("token");

        name = findViewById(R.id.username);
        Button btnSessions = findViewById(R.id.btn_sessions);

        Button btnReservations = findViewById(R.id.btn_reservations);


        if(intent.getExtras() != null){
            String passedName = intent.getStringExtra("name");


                    name.setText("Bienvenue "+ passedName);
            String role = intent.getStringExtra("role");


        }

      Button  btnLogout = findViewById(R.id.btn_logout);


        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

      String deviceName = Build.MODEL;



                UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);



                Call<ApiResponse> call = service.logout();
                call.enqueue(new Callback<ApiResponse>() {
                    @Override
                    public void onResponse(Call<ApiResponse> call, Response<ApiResponse> response) {

                        System.out.println(response.isSuccessful());



                        if(response.body().getMessage().contains("success")) {

                            startActivity(new Intent(DashboardActivity.this, MainActivity.class));
                            DashboardActivity.this.finish();
                        }
                     else{
                            Toast.makeText(DashboardActivity.this,"Échec ", Toast.LENGTH_LONG).show();

                        }

                    }

                    @Override
                    public void onFailure(Call<ApiResponse> call, Throwable t) {
                        Toast.makeText(DashboardActivity.this,"Throwable "+t.getLocalizedMessage(), Toast.LENGTH_LONG).show();

                    }
                });


            }
        });



        btnSessions.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                startActivity(new Intent(DashboardActivity.this, SessionsActivity.class).putExtra("token",token));

            }
        });


      btnReservations.setOnClickListener(new View.OnClickListener() {
        @Override
        public void onClick(View v) {

            startActivity(new Intent(DashboardActivity.this, ReservationActivity.class).putExtra("token",token));

        }
    });
}

}