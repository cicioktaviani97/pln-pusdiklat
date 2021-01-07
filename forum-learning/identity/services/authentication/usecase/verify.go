package usecase

import (
	"fmt"
	"log"
	"strconv"

	"github.com/dgrijalva/jwt-go"
	"github.com/wildangbudhi/pln-pusdiklat/forum-learning/identity/services/authentication/domain"
)

func verifyToken(stringToken string, secretKey []byte) (*jwt.Token, error) {
	token, err := jwt.Parse(stringToken, func(token *jwt.Token) (interface{}, error) {

		if _, ok := token.Method.(*jwt.SigningMethodHMAC); !ok {
			return nil, fmt.Errorf("Unexpected signing method: %v", token.Header["alg"])
		}

		return secretKey, nil

	})

	if err != nil {
		return nil, err
	}

	return token, nil

}

func (usecase *authenticationUsecase) Verify(token string) (*domain.VerifyUsecaseResponse, error) {

	jwtTokenObject, err := verifyToken(token, usecase.secretKey)

	if err != nil {
		return nil, err
	}

	claims, ok := jwtTokenObject.Claims.(jwt.MapClaims)

	if !ok || !jwtTokenObject.Valid {
		return nil, fmt.Errorf("Token Tidak Valid")
	}

	log.Println(claims)
	log.Println(claims["id"])

	userID, ok := claims["id"].(string)

	if !ok {
		return nil, fmt.Errorf("Metadata Token Tidak Ditemukan, Silahkan Coba Lagi")
	}

	userIDInt, err := strconv.Atoi(userID)

	if err != nil {
		return nil, fmt.Errorf("Format ID Tidak Valid")
	}

	userAuth, err := usecase.userAuthRepository.GetUserAuthByID(userIDInt)

	if err != nil {
		return nil, err
	}

	response := &domain.VerifyUsecaseResponse{
		ID:       userAuth.ID,
		FullName: userAuth.FullName.String,
		Email:    userAuth.Email,
		Username: userAuth.Username,
		Roles:    userAuth.Roles,
	}

	return response, nil

}