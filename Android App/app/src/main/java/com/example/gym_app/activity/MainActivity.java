package com.example.gym_app.activity;


import android.content.Intent;

import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gym_app.model.LoginRequest;
import com.example.gym_app.model.LoginResponse;
import com.example.gym_app.R;
import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.google.android.material.textfield.TextInputEditText;

import androidx.appcompat.app.AppCompatActivity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class MainActivity extends AppCompatActivity {


    TextInputEditText username, password;
    TextView btnLogin,btnToRegister;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        username = findViewById(R.id.edUsername);
        password = findViewById(R.id.edPassword);
        btnLogin = findViewById(R.id.btnLogin);
        btnToRegister = findViewById(R.id.btn_toRegister);


        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(TextUtils.isEmpty(username.getText().toString()) || TextUtils.isEmpty(password.getText().toString())){
                    Toast.makeText(MainActivity.this,"Vous devez entrer Email / Mot de passe", Toast.LENGTH_LONG).show();
                }else{
                    //proceed to login
                    login();
                }

            }
        });

        btnToRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                startActivity(new Intent(MainActivity.this, RegisterActivity.class));

            }
        });


    }


    public void login(){
        String deviceName = Build.MODEL;

        LoginRequest loginRequest = new LoginRequest();
        loginRequest.setEmail(username.getText().toString());
        loginRequest.setPassword(password.getText().toString());
        loginRequest.setDeviceName(deviceName.toString());


        Call<LoginResponse> loginResponseCall = ApiClient.getUserService().userLogin(loginRequest);
        loginResponseCall.enqueue(new Callback<LoginResponse>() {
            @Override
            public void onResponse(Call<LoginResponse> call, Response<LoginResponse> response) {

                if(response.isSuccessful()){
                    Toast.makeText(MainActivity.this,"Connexion réussie", Toast.LENGTH_LONG).show();
                    LoginResponse loginResponse = response.body();

                    UserData x = UserData.getInstance();
x.token =  loginResponse.getToken();
                    x.role =  loginResponse.getRole();
                    new Handler().postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            Bundle bundle = new Bundle();
                            bundle.putString("name",loginResponse.getUser().getName());
                            bundle.putString("role",loginResponse.getRole());
                            bundle.putString("token", loginResponse.getToken());
                       //     startActivity(new Intent(MainActivity.this, DashboardActivity.class).putExtra(bundle));
                            Intent intent = new Intent(MainActivity.this, DashboardActivity.class);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    },700);

                }else{
                    Toast.makeText(MainActivity.this,"Échec de la connexion", Toast.LENGTH_LONG).show();

                }

            }

            @Override
            public void onFailure(Call<LoginResponse> call, Throwable t) {
                Toast.makeText(MainActivity.this,"Throwable "+t.getLocalizedMessage(), Toast.LENGTH_LONG).show();

            }
        });


    }

}