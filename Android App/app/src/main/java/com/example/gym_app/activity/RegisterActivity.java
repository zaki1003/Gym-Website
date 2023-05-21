package com.example.gym_app.activity;

import android.content.Intent;

import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.example.gym_app.model.LoginResponse;
import com.example.gym_app.R;
import com.example.gym_app.model.RegisterRequest;
import com.example.gym_app.model.UserData;

import com.example.gym_app.network.ApiClient;
import com.google.android.material.textfield.TextInputEditText;

import androidx.appcompat.app.AppCompatActivity;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class RegisterActivity extends AppCompatActivity {


    TextInputEditText name, email,password,passwordConfirmation;
    Button btnRegister;
    TextView btnToLogin;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        name = findViewById(R.id.edName);
        email = findViewById(R.id.edEmail);
        password = findViewById(R.id.edPassword);
        passwordConfirmation = findViewById(R.id.edPassword);
        btnRegister = findViewById(R.id.btnRegister);
        btnToLogin = findViewById(R.id.btn_toLogin);
        btnRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(TextUtils.isEmpty(name.getText().toString()) || TextUtils.isEmpty(email.getText().toString())  || TextUtils.isEmpty(password.getText().toString())   || TextUtils.isEmpty(passwordConfirmation.getText().toString())      ){
                    Toast.makeText(RegisterActivity.this,"Vous devez entrer Nom / Email / Mot de passe / Confirmation du mot de passed", Toast.LENGTH_LONG).show();





                }else if( password.getText().toString()==passwordConfirmation.getText().toString()){
                    Toast.makeText(RegisterActivity.this,"Le mot de passe et la confirmation du mot de passe doivent être identiques", Toast.LENGTH_LONG).show();

                }

                else{
                    //proceed to login
                    register();
                }

            }
        });



        btnToLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                startActivity(new Intent(RegisterActivity.this, MainActivity.class));

            }
        });


    }


    public void register(){
        String deviceName = Build.MODEL;

        RegisterRequest registerRequest = new RegisterRequest();
        registerRequest.setName(name.getText().toString());
        registerRequest.setEmail(email.getText().toString());
        registerRequest.setPassword(password.getText().toString());
        registerRequest.setPassword_confirmation(passwordConfirmation.getText().toString());
        registerRequest.setDevice_name(deviceName.toString());


        Call<LoginResponse> loginResponseCall = ApiClient.getUserService().userRegister(registerRequest);
        loginResponseCall.enqueue(new Callback<LoginResponse>() {
            @Override
            public void onResponse(Call<LoginResponse> call, Response<LoginResponse> response) {

                if(response.isSuccessful()){
                    Toast.makeText(RegisterActivity.this,"Connexion réussie", Toast.LENGTH_LONG).show();
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
                            //     startActivity(new Intent(RegisterActivity.this, DashboardActivity.class).putExtra(bundle));
                            Intent intent = new Intent(RegisterActivity.this, DashboardActivity.class);
                            intent.putExtras(bundle);
                            startActivity(intent);
                        }
                    },700);

                }else{
                    Toast.makeText(RegisterActivity.this,"Le couriel a déja été pris en compte.", Toast.LENGTH_LONG).show();

                }

            }

            @Override
            public void onFailure(Call<LoginResponse> call, Throwable t) {
                Toast.makeText(RegisterActivity.this,"Throwable "+t.getLocalizedMessage(), Toast.LENGTH_LONG).show();

            }
        });


    }

}