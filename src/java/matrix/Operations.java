/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package matrix;

/**
 *
 * @author matte
 */
public class Operations {
    public Operations(){}
    
    public static int[][] convolution2D(int[][] inputImage, int width, int height, int[][] kernel, int kernelWidth, int kernelHeight){
        int smallWidth = width; //- kernelWidth + 1;
        int smallHeight = height; //- kernelHeight + 1;
        int[][] output = new int[smallHeight][smallWidth];
        for (int i = 0; i < smallHeight; ++i) {
            for (int j = 0; j < smallWidth; ++j) {
                output[i][j] = 0;
            }
        }
        
        
        for (int i = 0; i < smallHeight; ++i) {
            for (int j = 0; j < smallWidth; ++j) {
                output[i][j] = singlePixelConvolution(inputImage, i, j, kernel, kernelWidth, kernelHeight);
            }
        }
        return output;
    }
    
    public static int singlePixelConvolution( int[][] input, int x, int y, int[][] k,int kernelWidth, int kernelHeight){
        int output = 0;
        for (int i = 0; i < kernelHeight; ++i) {
            for (int j = 0; j < kernelWidth; ++j) {
                try {
                    output = output + (input[x + i][y + j] * k[i][j]);
                } catch (Exception e) {
                    continue;
                }
            }
        }
        return output;
    }
    
    public static double[][] convolution2D(double[][] inputImage, int width, int height, double[][] kernel, int kernelWidth, int kernelHeight){
        int smallWidth = width; //- kernelWidth + 1;
        int smallHeight = height; //- kernelHeight + 1;
        double[][] output = new double[smallHeight][smallWidth];
        for (int i = 0; i < smallHeight; ++i) {
            for (int j = 0; j < smallWidth; ++j) {
                output[i][j] = 0.0;
            }
        }
        
        
        for (int i = 0; i < smallHeight; ++i) {
            for (int j = 0; j < smallWidth; ++j) {
                output[i][j] = singlePixelConvolution(inputImage, i, j, kernel, kernelWidth, kernelHeight);
            }
        }
        return output;
    }
    
    public static double singlePixelConvolution( double[][] input, int x, int y, double[][] k,int kernelWidth, int kernelHeight){
        double output = 0;
        for (int i = 0; i < kernelHeight; ++i) {
            for (int j = 0; j < kernelWidth; ++j) {
                try {
                    output = output + (input[x + i][y + j] * k[i][j]);
                } catch (Exception e) {
                    continue;
                }
            }
        }
        return output;
    }
    
}
