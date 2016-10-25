/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javarobot;
import java.awt.Robot;
import java.awt.event.InputEvent;
import java.awt.event.KeyEvent;
import java.awt.Dimension;

/**
 *
 * @author tech0165
 */
public class JavaRobot {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        try {
            Dimension screenSize = java.awt.Toolkit.getDefaultToolkit().getScreenSize();
            Robot robot = new Robot();
            robot.mouseMove((int) (screenSize.getWidth()/2), (int) (screenSize.getHeight()/2));
            robot.mousePress(InputEvent.BUTTON1_MASK);
            robot.mouseRelease(InputEvent.BUTTON1_MASK);
            robot.delay(500);
            robot.keyPress(KeyEvent.VK_ENTER);
            robot.keyRelease(KeyEvent.VK_ENTER);
        } catch (Exception e) {
            
        }
    }
    
}
